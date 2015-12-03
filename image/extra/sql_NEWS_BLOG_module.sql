UPDATE `oc_product_description` SET `meta_title` =  'Product';
UPDATE `oc_category_description` SET `meta_title` = 'Category';

DELETE FROM `oc_news`;
DELETE FROM `oc_news_description`;

INSERT INTO `oc_news` (`news_id`, `image`, `date_added`, `status`) VALUES
(1, 'catalog/sliders/slide1-1.png', '2015-02-20 13:29:02', 1),
(2, '', '2015-02-26 15:56:32', 1);

INSERT INTO `oc_news_description` (`news_description_id`, `news_id`, `language_id`, `title`, `description`, `short_description`) VALUES
(2, 1, 1, 'Fusce eu dui', 'Integer vel nibh sit &amp;nbsp; amet turpis vulputate aliquet. Phasellus id nisi vitae odio pretium aliquam.', ''),
(3, 2, 1, 'Fusce eu dui.', 'Integer vel nibh sit &amp;nbsp; amet turpis vulputate aliquet. Phasellus id nisi vitae odio pretium aliquam.', ''),
(4, 2, 2, 'Fusce eu dui.', 'Integer vel nibh sit &amp;nbsp; amet turpis vulputate aliquet. Phasellus id nisi vitae odio pretium aliquam.', '');

DELETE FROM `oc_layout_module` WHERE `position` = 'content_blog';

INSERT INTO `oc_layout_module` (`layout_module_id`, `layout_id`, `code`, `position`, `sort_order`) VALUES
(null, 1, 'news', 'content_blog', 1),
(null, 2, 'news', 'content_blog', 1),
(null, 3, 'news', 'content_blog', 1),
(null, 4, 'news', 'content_blog', 1),
(null, 5, 'news', 'content_blog', 1),
(null, 6, 'news', 'content_blog', 1),
(null, 7, 'news', 'content_blog', 1),
(null, 8, 'news', 'content_blog', 1),
(null, 9, 'news', 'content_blog', 1),
(null, 10, 'news', 'content_blog', 1),
(null, 11, 'news', 'content_blog', 1),
(null, 12, 'news', 'content_blog', 1),
(null, 13, 'news', 'content_blog', 1);


DELETE FROM `oc_layout` WHERE `layout_id` = 30;
DELETE FROM `oc_layout` WHERE `layout_id` = 31;
DELETE FROM `oc_layout` WHERE `layout_id` = 32;
DELETE FROM `oc_layout` WHERE `layout_id` = 33;

INSERT INTO `oc_layout` (`layout_id`, `name`) VALUES
(30, 'Simple Blog Posts'),
(31, 'Simple Blog Single Post'),
(32, 'Simple Blog Category'),
(33, 'Simple Blog Author');

DELETE FROM `oc_layout_route` WHERE `layout_id` = 30;
DELETE FROM `oc_layout_route` WHERE `layout_id` = 31;
DELETE FROM `oc_layout_route` WHERE `layout_id` = 32;
DELETE FROM `oc_layout_route` WHERE `layout_id` = 33;

INSERT INTO `oc_layout_route` (`layout_route_id`, `layout_id`, `store_id`, `route`) VALUES
(null, 30, 0, 'simple_blog/article'),
(null, 32, 0, 'simple_blog/category'),
(null, 33, 0, 'simple_blog/author'),
(null, 31, 0, 'simple_blog/article/view');

DELETE FROM `oc_simple_blog_article`;
DELETE FROM `oc_simple_blog_view`;
DELETE FROM `oc_simple_blog_comment`;
DELETE FROM `oc_simple_blog_category_to_store`;
DELETE FROM `oc_simple_blog_author_description`;
DELETE FROM `oc_simple_blog_author`;
DELETE FROM `oc_simple_blog_article_description_additional`;
DELETE FROM `oc_simple_blog_article_description`;

INSERT INTO `oc_simple_blog_author` (`simple_blog_author_id`, `name`, `image`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Admin', '', 1, '2015-03-05 14:36:08', '2015-03-05 14:36:08');

INSERT INTO `oc_simple_blog_author_description` (`simple_blog_author_description_id`, `simple_blog_author_id`, `language_id`, `description`, `meta_description`, `meta_keyword`, `date_added`) VALUES
(NULL, 1, 1, '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '', '', '0000-00-00 00:00:00');

INSERT INTO `oc_simple_blog_article` (`simple_blog_article_id`, `simple_blog_author_id`, `allow_comment`, `image`, `featured_image`, `article_related_method`, `article_related_option`, `sort_order`, `status`, `date_added`, `date_modified`) VALUES
(1, 1, 1, 'catalog/blog/blog-img-01.jpg', 'catalog/blog/blog-img.jpg', 'product_wise', '', 1, 1, '2015-03-05 18:22:18', '2015-03-20 13:17:12'),
(2, 1, 1, 'catalog/blog/blog-img-02.jpg', 'catalog/blog/blog-img.jpg', 'product_wise', '', 2, 1, '2015-03-05 18:37:30', '2015-03-05 18:37:30'),
(3, 1, 1, 'catalog/blog/blog-img-03.jpg', 'catalog/blog/blog-img.jpg', 'product_wise', '', 3, 1, '2015-03-05 18:54:06', '2015-03-05 18:54:06'),
(4, 1, 1, 'catalog/blog/blog-img-04.jpg', 'catalog/blog/blog-img.jpg', 'product_wise', '', 4, 1, '2015-03-05 18:54:56', '2015-03-05 18:54:56'),
(5, 1, 1, 'catalog/blog/blog-img-05.jpg', 'catalog/blog/blog-img.jpg', 'product_wise', '', 5, 1, '2015-03-05 18:55:31', '2015-03-05 18:55:31'),
(6, 1, 1, 'catalog/blog/blog-post-06.jpg', 'catalog/blog/blog-img.jpg', 'product_wise', '', 6, 1, '2015-03-05 18:56:24', '2015-03-05 18:56:24');

INSERT INTO `oc_simple_blog_article_description` (`simple_blog_article_description_id`, `simple_blog_article_id`, `language_id`, `article_title`, `description`, `meta_description`, `meta_keyword`) VALUES
(NULL, 1, 1, 'Blog post number 1', '                  &lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam. Nulla libero. &lt;/p&gt;\r\n                  &lt;p&gt;Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. &lt;/p&gt;\r\n                  &lt;div class=&quot;blockquote&quot;&gt;\r\n                    &lt;div class=&quot;inside&quot;&gt;\r\n                      &lt;p&gt;Curabitur convallis facilisis lorem. Vivamus euismod nulla vel nunc. Fusce tincidunt, justo congue egestas molestie, tortor tortor blandit erat, et scelerisque metus metus at ipsum. Maecenas tincidunt adipiscing tellus. Nunc tristique pede. Ut condimentum mattis est. Duis sit amet augue. &lt;/p&gt;\r\n                    &lt;/div&gt;\r\n                  &lt;/div&gt;\r\n', '', ''),
(NULL, 2, 1, 'Blog post number 2', '                  &lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam. Nulla libero. &lt;/p&gt;\r\n                  &lt;p&gt;Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. &lt;/p&gt;\r\n                  &lt;div class=&quot;blockquote&quot;&gt;\r\n                    &lt;div class=&quot;inside&quot;&gt;\r\n                      &lt;p&gt;Curabitur convallis facilisis lorem. Vivamus euismod nulla vel nunc. Fusce tincidunt, justo congue egestas molestie, tortor tortor blandit erat, et scelerisque metus metus at ipsum. Maecenas tincidunt adipiscing tellus. Nunc tristique pede. Ut condimentum mattis est. Duis sit amet augue. &lt;/p&gt;\r\n                    &lt;/div&gt;\r\n                  &lt;/div&gt;\r\n', '', ''),
(NULL, 3, 1, 'Blog post number 3', '                  &lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam. Nulla libero. &lt;/p&gt;\r\n                  &lt;p&gt;Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. &lt;/p&gt;\r\n                  &lt;div class=&quot;blockquote&quot;&gt;\r\n                    &lt;div class=&quot;inside&quot;&gt;\r\n                      &lt;p&gt;Curabitur convallis facilisis lorem. Vivamus euismod nulla vel nunc. Fusce tincidunt, justo congue egestas molestie, tortor tortor blandit erat, et scelerisque metus metus at ipsum. Maecenas tincidunt adipiscing tellus. Nunc tristique pede. Ut condimentum mattis est. Duis sit amet augue. &lt;/p&gt;\r\n                    &lt;/div&gt;\r\n                  &lt;/div&gt;\r\n', '', ''),
(NULL, 4, 1, 'Blog post number 4', '                  &lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam. Nulla libero. &lt;/p&gt;\r\n                  &lt;p&gt;Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. &lt;/p&gt;\r\n                  &lt;div class=&quot;blockquote&quot;&gt;\r\n                    &lt;div class=&quot;inside&quot;&gt;\r\n                      &lt;p&gt;Curabitur convallis facilisis lorem. Vivamus euismod nulla vel nunc. Fusce tincidunt, justo congue egestas molestie, tortor tortor blandit erat, et scelerisque metus metus at ipsum. Maecenas tincidunt adipiscing tellus. Nunc tristique pede. Ut condimentum mattis est. Duis sit amet augue. &lt;/p&gt;\r\n                    &lt;/div&gt;\r\n                  &lt;/div&gt;\r\n', '', ''),
(NULL, 5, 1, 'Blog post number 5', '                  &lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam. Nulla libero. &lt;/p&gt;\r\n                  &lt;p&gt;Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. &lt;/p&gt;\r\n                  &lt;div class=&quot;blockquote&quot;&gt;\r\n                    &lt;div class=&quot;inside&quot;&gt;\r\n                      &lt;p&gt;Curabitur convallis facilisis lorem. Vivamus euismod nulla vel nunc. Fusce tincidunt, justo congue egestas molestie, tortor tortor blandit erat, et scelerisque metus metus at ipsum. Maecenas tincidunt adipiscing tellus. Nunc tristique pede. Ut condimentum mattis est. Duis sit amet augue. &lt;/p&gt;\r\n                    &lt;/div&gt;\r\n                  &lt;/div&gt;\r\n', '', ''),
(NULL, 6, 1, 'Blog post number 6', '                  &lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam. Nulla libero. &lt;/p&gt;\r\n                  &lt;p&gt;Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. &lt;/p&gt;\r\n                  &lt;div class=&quot;blockquote&quot;&gt;\r\n                    &lt;div class=&quot;inside&quot;&gt;\r\n                      &lt;p&gt;Curabitur convallis facilisis lorem. Vivamus euismod nulla vel nunc. Fusce tincidunt, justo congue egestas molestie, tortor tortor blandit erat, et scelerisque metus metus at ipsum. Maecenas tincidunt adipiscing tellus. Nunc tristique pede. Ut condimentum mattis est. Duis sit amet augue. &lt;/p&gt;\r\n                    &lt;/div&gt;\r\n                  &lt;/div&gt;\r\n', '', '');

INSERT INTO `oc_simple_blog_article_description_additional` (`simple_blog_article_id`, `language_id`, `additional_description`) VALUES
(1, 1, '&lt;div class=&quot;text&quot;&gt;\r\n    &lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam. Nulla libero. &lt;/p&gt;\r\n    &lt;p&gt;Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. &lt;/p&gt;\r\n    &lt;div class=&quot;divider divider-sm&quot;&gt;&lt;/div&gt;\r\n    &lt;ul class=&quot;tags&quot;&gt;\r\n        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Web Design&lt;/a&gt;&lt;/li&gt;\r\n        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Wordpress&lt;/a&gt;&lt;/li&gt;\r\n        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Animation&lt;/a&gt;&lt;/li&gt;\r\n    &lt;/ul&gt;\r\n    &lt;div class=&quot;clearfix&quot;&gt;&lt;/div&gt;\r\n    &lt;div class=&quot;divider divider-lg&quot;&gt;&lt;/div&gt;\r\n&lt;/div&gt;\r\n'),
(2, 1, '&lt;div class=&quot;text&quot;&gt;\r\n    &lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam. Nulla libero. &lt;/p&gt;\r\n    &lt;p&gt;Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. &lt;/p&gt;\r\n    &lt;div class=&quot;divider divider-sm&quot;&gt;&lt;/div&gt;\r\n    &lt;ul class=&quot;tags&quot;&gt;\r\n        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Web Design&lt;/a&gt;&lt;/li&gt;\r\n        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Wordpress&lt;/a&gt;&lt;/li&gt;\r\n        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Animation&lt;/a&gt;&lt;/li&gt;\r\n    &lt;/ul&gt;\r\n    &lt;div class=&quot;clearfix&quot;&gt;&lt;/div&gt;\r\n    &lt;div class=&quot;divider divider-lg&quot;&gt;&lt;/div&gt;\r\n&lt;/div&gt;\r\n'),
(3, 1, '&lt;div class=&quot;text&quot;&gt;\r\n    &lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam. Nulla libero. &lt;/p&gt;\r\n    &lt;p&gt;Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. &lt;/p&gt;\r\n    &lt;div class=&quot;divider divider-sm&quot;&gt;&lt;/div&gt;\r\n    &lt;ul class=&quot;tags&quot;&gt;\r\n        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Web Design&lt;/a&gt;&lt;/li&gt;\r\n        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Wordpress&lt;/a&gt;&lt;/li&gt;\r\n        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Animation&lt;/a&gt;&lt;/li&gt;\r\n    &lt;/ul&gt;\r\n    &lt;div class=&quot;clearfix&quot;&gt;&lt;/div&gt;\r\n    &lt;div class=&quot;divider divider-lg&quot;&gt;&lt;/div&gt;\r\n&lt;/div&gt;\r\n'),
(4, 1, '&lt;div class=&quot;text&quot;&gt;\r\n    &lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam. Nulla libero. &lt;/p&gt;\r\n    &lt;p&gt;Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. &lt;/p&gt;\r\n    &lt;div class=&quot;divider divider-sm&quot;&gt;&lt;/div&gt;\r\n    &lt;ul class=&quot;tags&quot;&gt;\r\n        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Web Design&lt;/a&gt;&lt;/li&gt;\r\n        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Wordpress&lt;/a&gt;&lt;/li&gt;\r\n        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Animation&lt;/a&gt;&lt;/li&gt;\r\n    &lt;/ul&gt;\r\n    &lt;div class=&quot;clearfix&quot;&gt;&lt;/div&gt;\r\n    &lt;div class=&quot;divider divider-lg&quot;&gt;&lt;/div&gt;\r\n&lt;/div&gt;\r\n'),
(5, 1, '&lt;div class=&quot;text&quot;&gt;\r\n    &lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam. Nulla libero. &lt;/p&gt;\r\n    &lt;p&gt;Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. &lt;/p&gt;\r\n    &lt;div class=&quot;divider divider-sm&quot;&gt;&lt;/div&gt;\r\n    &lt;ul class=&quot;tags&quot;&gt;\r\n        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Web Design&lt;/a&gt;&lt;/li&gt;\r\n        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Wordpress&lt;/a&gt;&lt;/li&gt;\r\n        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Animation&lt;/a&gt;&lt;/li&gt;\r\n    &lt;/ul&gt;\r\n    &lt;div class=&quot;clearfix&quot;&gt;&lt;/div&gt;\r\n    &lt;div class=&quot;divider divider-lg&quot;&gt;&lt;/div&gt;\r\n&lt;/div&gt;\r\n'),
(6, 1, '&lt;div class=&quot;text&quot;&gt;\r\n    &lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam. Nulla libero. &lt;/p&gt;\r\n    &lt;p&gt;Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. &lt;/p&gt;\r\n    &lt;div class=&quot;divider divider-sm&quot;&gt;&lt;/div&gt;\r\n    &lt;ul class=&quot;tags&quot;&gt;\r\n        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Web Design&lt;/a&gt;&lt;/li&gt;\r\n        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Wordpress&lt;/a&gt;&lt;/li&gt;\r\n        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Animation&lt;/a&gt;&lt;/li&gt;\r\n    &lt;/ul&gt;\r\n    &lt;div class=&quot;clearfix&quot;&gt;&lt;/div&gt;\r\n    &lt;div class=&quot;divider divider-lg&quot;&gt;&lt;/div&gt;\r\n&lt;/div&gt;\r\n');

INSERT INTO `oc_simple_blog_view` (`simple_blog_view_id`, `simple_blog_article_id`, `view`, `date_added`, `date_modified`) VALUES
(1, 1, 115, '2015-03-05 18:23:19', '2015-03-20 13:31:09'),
(2, 5, 10, '2015-03-05 18:56:45', '2015-03-20 13:16:57'),
(3, 4, 31, '2015-03-10 15:39:11', '2015-03-11 13:11:07'),
(4, 6, 36, '2015-03-10 19:49:11', '2015-04-20 01:48:46'),
(5, 2, 2, '2015-03-13 11:32:39', '2015-03-13 11:32:40');

INSERT INTO `oc_simple_blog_comment` (`simple_blog_comment_id`, `simple_blog_article_id`, `simple_blog_article_reply_id`, `author`, `comment`, `status`, `date_added`, `date_modified`) VALUES
(NULL, 1, 0, 'John Doe', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, es', 1, '2015-03-12 13:46:22', '2015-03-12 13:46:22'),
(NULL, 1, 1, 'Elizabeth', 'Curabitur convallis facilisis lorem. Vivamus euismod nulla vel nunc. Fusce tincidunt, justo congue egestas molestie,', 1, '2015-03-12 13:51:45', '2015-03-12 13:51:45');

INSERT INTO `oc_simple_blog_category_to_store` (`simple_blog_category_id`, `store_id`) VALUES
(1, 0),
(2, 0);



INSERT INTO `oc_simple_blog_article_to_store` (`simple_blog_article_id`, `store_id`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(5, 0),
(6, 0);

DELETE FROM `oc_setting` WHERE `code` = 'simple_blog';

INSERT INTO `oc_setting` (`setting_id`, `store_id`, `code`, `key`, `value`, `serialized`) VALUES
(null, 0, 'simple_blog', 'simple_blog_module', '{"221tjpaslqflayvi":{"article_limit":"6","image_width":"205","image_height":"195","module_type":"1","category_id":"all","status":"1","sort_order":""}}', 1),
(null, 0, 'simple_blog', 'simple_blog_share_social_site', '0', 0),
(null, 0, 'simple_blog', 'simple_blog_related_articles', '0', 0),
(null, 0, 'simple_blog', 'simple_blog_author_information', '0', 0),
(null, 0, 'simple_blog', 'simple_blog_comment_auto_approval', '1', 0),
(null, 0, 'simple_blog', 'simple_blog_display_category', '1', 0),
(null, 0, 'simple_blog', 'simple_blog_comment_related_heading', 'Comments', 0),
(null, 0, 'simple_blog', 'simple_blog_product_related_heading', 'Product related', 0),
(null, 0, 'simple_blog', 'simple_blog_status', '1', 0),
(null, 0, 'simple_blog', 'simple_blog_seo_keyword', 'blog', 0),
(null, 0, 'simple_blog', 'simple_blog_footer_heading', 'Blog', 0),
(null, 0, 'simple_blog', 'simple_blog_heading', 'Blog posts', 0);

DELETE FROM `oc_layout_module` WHERE `code` = 'simple_blog';
DELETE FROM `oc_layout_module` WHERE `layout_id` = '30';
DELETE FROM `oc_layout_module` WHERE `layout_id` = '31';

INSERT INTO `oc_layout_module` (`layout_module_id`, `layout_id`, `code`, `position`, `sort_order`) VALUES
(null, 1, 'simple_blog', 'content_top', 6),

(null, 31, 'html.49', 'column_right', 3),
(null, 31, 'simple_blog_category', 'column_right', 1),
(null, 31, 'html.39', 'column_right', 2),
(null, 31, 'html.32', 'top_promo', 1),
(null, 31, 'news', 'content_blog', 1),
(null, 30, 'news', 'content_blog', 1),
(null, 30, 'html.32', 'top_promo', 1);
