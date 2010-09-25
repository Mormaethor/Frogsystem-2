<?php
/**
 * @file     class_sql.php
 * @folder   /libs
 * @version  0.3
 * @author   Satans Kr�melmonster, Sweil
 *
 * this class provides several methodes for database-access
 */
 

 
 
class sql {
 #FFFFFF
    private $sql;                   // Die Verbindungs-Resource
    private $pref;                  // Tabellen-Pr�fix (siehe inc_login.php)
    private $error;                 // evtl. aufgetretene SQL-Fehler
    private $qrystr;                // Speicher f�r den zusammengebauten SQL-Query-String
    private $resultres = FALSE;     // Speichert die Ergebnis-Resource einer Abfrage
    private $useful = FALSE;        // Ergebnis ist umgangsprachlich n�tzlich

    // Der Konstrukter
    // Speichert Die SQL-Verbindung, den Datenbank-Namen und das Pr�fix zur sp�tern Verwendung und stellt eine Verbindung her
    public function __construct ( $host, $data, $user, $pass, $pref ) {
        $this->sql = @mysql_connect ( $host, $user, $pass );
        if ( $this->sql && mysql_select_db ( $data, $this->sql ) ) {
            $this->db = $data;
            $this->pref = $pref;
        } else {
            $this->sql = null; // Bei Fehler auf NULL setzen (NULL kann leicht abgefragt werden)
        }
    }

    //Gibt die gespeicherte MySQL-Ressource zur�ck
    public function getRes () {  // DEPRECATED
        return $this->getResource();
    }
    public function getResource () {
        if ( isset ( $this->sql ) && $this->sql !== null ) {
            return $this->sql;
        } else {
            return FALSE;  // Und wenn es keine gibt, gibt die Funktion FALSE zur�ck
        }
    }

    // Gibt einen Array mit evtl. aufgetretenem Fehler zur�ck
    public function getError () {
        if ( isset ( $this->error ) && $this->error !== null ) {
            return $this->error;
        } else {
            return FALSE;
        }
    }

    // Gibt den Query-String der letzten Abfrage oder FALSE zur�ck
    public function lastQueryString () {
        if ( isset ( $this->qrystr ) && $this->qrystr !== null ) {
            return $this->qrystr;
        } else {
            return FALSE;
        }
    }
    public function getQueryString () {
        return $this->lastQueryString();
    }

    // F�hrt den gespeicherten Query-String tats�chlich aus
    private function doQuery () {
        if ( !isset ( $this->qrystr ) ) { // Abbruch, wenn kein Query-String gespeichert ist
            return FALSE;
        }
        
        $this->resultres = mysql_query($this->qrystr, $this->sql); // Query ausf�hren
        unset( $this->error ); // Fehler-Array zur�cksetzen
        $this->useful = FALSE; // N�tzlichkeit auf FALSE setzen
        if ( mysql_error ( $this->sql ) !== "" ) { // Falls ein Fehler auftritt
            $this->error[0] = mysql_errno($this->sql); // Fehler Nummer
            $this->error[1] = mysql_error($this->sql); // Text-Beschreibung des Fehlers
            return FALSE;
        } else {
            return $this->resultres;
        }
    }

    // Eine beliebige Abfrage
    public function executeQuery ( $qrystr ) {
        $this->qrystr = str_replace ( "{..pref..}", $this->pref, $qrystr ); // {..pref..} wird automatisch ersetzt, so dass flexibel programmiert werden kann
        return $this->doQuery();
    }
    public function query ( $qrystr ) { // DEPRECATED
        return $this->executeQuery( $qrystr );
    }

    // Gibt die letzte Insert-ID zur�ck
    public function lastInsertId (){
        if ( $this->getResource() === FALSE ) {
            return FALSE;
        }
        return mysql_insert_id ( $this->sql );
    }
    public function getInsertId (){  // DEPRECATED
        return $this->lastInsertId();
    }
    
    // Gibt Anzahl der Reihen der letzten Abfrage zur�ck
    public function lastNumRows (){
        if ( $this->resultres === FALSE ) {
            return FALSE;
        }
        return mysql_num_rows ( $this->resultres );
    }

    // Eine SELECT-Abfrage ausf�hren
    // $addititional = 0 => Normal (Array der Zeilen), bei leerem Ergebnis: 0
    // $addititional = 1 => nur das Array der ersten Ergebnis-Zeile
    // Achtung: Bei nur einem abgefragten Feld: als R�ckgabe erfolgt der Wert, kein Array!!
    // $addititional = 2 => Anzahl der Ergebnis-Zeilen
    // $addititional = 3 => wie 1, nur erfolgt die R�ckgabe auf jeden Fall als array
    public function getData ( $table, $cols, $optional = "", $addititional = 0, $distinct = FALSE ) {
        // Daten f�r Spalten  laden
        // Kann *, Array oder CSV sein
        if ( $cols == "*" ) {
            $cols = "*";
        } else {
            $cols = ( is_array ( $cols ) ) ? $cols : explode ( ",", $cols );
            $this->arraytrim ( &$cols ) ;
            $cols = "`" . implode ( "`, `", $cols ) . "`";
        }

        // SELECT-Abfrage mit DISTINCT Attribut oder nicht
        $select = ( $distinct ) ? "SELECT DISTINCT " : "SELECT ";

        // Querystring aufbauen
        $qrystr = $select . $cols . " FROM `" . $this->pref . $table . "`";

        // evtl. Optionale Angaben (WHERE, LIMT, etc.) anh�ngen
        if ( !empty ( $optional ) ) {
            $qrystr .= " ".$optional;
        }

        // Query-String in Objekt ablegen
        $this->qrystr = $qrystr;

        // Query durchf�hren
        $qry = $this->doQuery();

        // Wenn Fehler auftreten
        if ( $qry === FALSE ) {
            return FALSE;

        // Keine Fehler
        } else {
            // Wenn nur nach der Anzahl der Ergebnis-Zeilen gefragt ist
            // oder wenn keine passenden Zeilen gefunden wurden
            if ( $addititional == 2 ) {
                $this->useful = TRUE; // Ergebnis ist n�tzlich
                return mysql_num_rows ( $qry );
            } elseif ( mysql_num_rows ( $qry ) == 0 ) {
                return mysql_num_rows ( $qry );  // Ergebnis ist nicht n�tzlich, da keine Inhalte gefunden wurden
            }

            // Die ganzen Ergebnisse laden
            $ret = array();
            while( $erg = mysql_fetch_assoc ( $qry ) ) {
                $ret[]= $erg;
            }

            // Ergebnis ist n�tzlich
            $this->useful = TRUE;

            // Art der R�ckgabe (also $addititional) durch-switchen
            switch ( $addititional ) {
                case 0: // Standard-R�ckgabe
                    return $ret;
                    break;
                case 1: // nur die erste Ergebnis-Zeile
                    if ( count ( $ret[0] ) === 1 ) { // Wenn das Ergebnis nur aus einem Wert besteht, wird dieser direkt zur�ckgeben und nicht als Array
                        $keys = array_keys ( $ret[0] ) ; // Entsprechend wird hier der 1. Key des Arrays ermittelt
                        return $ret[0][$keys[0]]; // Und anschlie�end zur R�ckgabe verwendet
                    } else {
                        return $ret[0]; // Die erste Ergebnis-Zeile zur�ckgeben
                    }
                    break;
                    
                // Fall 2 wird oben abfangen
                
                case 3: // nur die erste Ergebnis-Zeile, selbst wenn nur ein Feld abgefragt wird...
                    return $ret[0]; // Die erste Ergebnis-Zeile zur�ckgeben
                    break;
            }
        }
    }

    // Eine Insert-Anweisung durchf�hren
    public function setData ( $table, $cols, $values ) {
        // Daten f�r Spalten und Werte laden
        // K�nnen CSV oder Arrays sein
        $cols   = ( is_array ( $cols ) ) ? $cols : explode ( ",", $cols );
        $values = ( is_array ( $values ) ) ? $values : explode ( ",", $values );

        // Darf nat�rlich nur soviele Werte wie Spalten geben
        if ( count ( $values ) !== count ( $cols ) || count ( $cols ) === 0 ) {
            return FALSE;
        }

        // Daten f�r Query vorbereiten
        $this->arraytrim ( &$cols ) ;
        $cols   = "`" . implode ( "`, `", $cols ) . "`";
        $this->arraytrim ( &$values ) ;
        $values = "'" . implode ( "', '", $values ) . "'";

        // Query-String aufbauen ...
        $this->qrystr = "INSERT INTO `".$this->pref.$table."` (".$cols.") VALUES (".$values.")";
        return $this->doQuery(); // ... und ausf�hren
    }

    // Eine Update-Anweisung durchf�hren
    public function updateData ( $table, $cols, $values, $additional = "" ) {
        // Daten f�r Spalten und Werte laden
        // K�nnen CSV oder Arrays sein
        $cols   = ( is_array ( $cols ) ) ? $cols : explode ( ",", $cols );
        $values = ( is_array ( $values ) ) ? $values : explode ( ",", $values );

        // Darf nat�rlich nur soviele Werte wie Spalten geben
        if ( count ( $values ) !== count ( $cols ) || count ( $cols ) === 0 ) {
            return FALSE;
        }

        // Daten f�r Query vorbereiten
        $this->arraytrim ( &$cols ) 
        $this->arraytrim ( &$values ) ;

        // Query-String aufbauen ...
        $qrystr = "UPDATE `".$this->pref.$table."` SET ";
        for ( $i = 0; $i < count ( $cols ) ; $i++ ) { // jeden Eintrag durchgehen
            $qrystr .= "`".$cols[$i]."` = '".$values[$i]."'"; // entsprechend an den Query-String dranh�ngen
            if ( $i != count($cols)-1 ) { // Falls nicht der letzte Eintrag...
                $qrystr .= ", "; // ... muss ein Komma eingef�gt werden
            }
        }

        // Query-String fertig bauen mit der obligatorischen Erweiteung f�r z.b. WHERE oder LIMIT
        $qrystr .= !empty ( $additional ) ? " ".$additional : "";
        $this->qrystr = $qrystr;
        return $this->doQuery(); // ... und ausf�hren
    }

    // Eine Delete-Anweisung durchf�hren
    public function deleteData ( $table, $conditions = "", $additional = "" ) {
        // Bedinungen ($conditions) sind hier Pflicht, damit nicht ausversehen alle Daten gel�scht werden
        // $additional bezieht sich dementsprechend nur noch auf LIMIT o.�.
        $qrystr = "DELETE FROM `".$this->pref.$table."`";
        $qrystr .= !empty ( $conditions ) ? " WHERE ".$conditions : "";
        $qrystr .= !empty ( $additional ) ? " ".$additional : "";

        $this->qrystr = $qrystr;
        return $this->doQuery();
    }

    // Funktion die pr�ft ob eine getData-Abfrage im umgangsprachlichen Sinne n�tzlich war
    // d.h. dass Sie keinen Fehler erzeugt und min. 1 Ergebnis liefert
    // vereint letzendliche nur die Abfrage  mysql_error() == "" && mysql_num_rows(..) > 0 zu einer Methode
    public function lastUseful() {
        return $this->useful;
    }
    public function isUsefulGet () {
        return $this->lastUseful();
    }

    // Wendet die Methode "trim" rekrusiv auf alle Werte in einem Array an
    private function arraytrim ( $array ) {
        foreach ( $array as $key => $value ) { // Array durchgehen
            if ( is_array ( $array[$key] ) ) {  // Wenn der Wert ein Array ist...
                $this->arraytrim ( $array[$key] ); // ... die Funktion rekusriv aufrufen
            } else {
                $array[$key] = trim ( $value ); // sonst "trim" anwenden
            }
        }
        return $array; // zur�ckgeben
    }

    // Der Destruktor beendet zur Sicherheit die DB-Verbindung
    public function __destruct (){
        mysql_close ( $this->sql );
    }
}
?>
