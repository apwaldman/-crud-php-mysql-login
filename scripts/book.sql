-- --------------------------------------------------------

--
-- Estrutura da tabela `livro`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) ,
  `author` varchar(250) ,
  `borrowed` varchar(250) ,
  `user_borrowed` varchar(250) ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
--
-- Dump da tabela `livro`
--

INSERT INTO `book` (`id`, `title`, `author`, `borrowed`, `user_borrowed`) VALUES
(1, 'Poemas e ensaios', 'Edgar Allan Poe', 'S', 'Mauro'),
(2, 'O mundo como vontade e representação', 'Arthur Schopenhauer', 'S', 'Arthur'),
(3, 'Nas montanhas da loucura', 'Lovecraft',  'N', null),
(4, 'Dagon', 'Lovecraft',  'N', null),
(5, 'Insonia', 'Stephen King',  'S', 'apwaldman');