CREATE TABLE `siswa (
`id` int(11) NOT NULL,
`nis` varchar(11) NOT NULL,
`nama` varchar(50) NOT NULL,
`jenis_kelamin` varchar(10) NOT NULL,
`telp` varchar(15) NOT NULL,
`alamat` text NOT NULL,
`foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE siswa MODIFY id INT AUTO_INCREMENT PRIMARY KEY;