--
-- query to add the entry for the sitemap page in admin CP
-- (However, 'stats' might not be the best group so far.)
--

INSERT INTO `fs2_admin_cp` (`page_id`, `group_id`, `page_file`,
   `page_pos`, `page_int_sub_perm`)
   VALUES ('sitemap', 'stats', 'admin_sitemap.php', 4, 0);
