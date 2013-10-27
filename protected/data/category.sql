/**
 * Category test data sql.
 *
 * author: Jin Hu <bixuehujin@gmail.com>
 */


INSERT INTO `term`(`tid`, `vid`, `name`) VALUES
(1, 1, 'Web Develepment'),
(2, 1, 'Design'),
(3, 1, 'Front End'),
(4, 1, 'Database'),
(5, 1, 'PHP'),
(6, 1, 'Python'),
(7, 1, 'Java'),
(8, 1, 'Ruby'),
(9, 1, 'HTML'),
(10, 1, 'CSS'),
(11, 1, 'JavaScript'),
(12, 1, 'MySQL'),
(13, 1, 'Redis'),
(14, 1, 'MongoDB');

INSERT INTO `term_hierarchy`(`tid`, `parent`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 3),
(10, 3),
(11, 3),
(12, 4),
(13, 4),
(14, 4);

