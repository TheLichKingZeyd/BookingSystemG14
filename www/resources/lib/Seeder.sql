INSERT INTO `users` (`UserID`, `FirstName`, `LastName`, `Email`, `IsAssistant`, `Password`, `AllowEmail`) VALUES
(NULL, 'Oliver', 'Grå', 'oliver@live.com', 0, '$2y$10$q67nVuh8iN2pW9TGVBlSruHLzsE/unwH1R2sGbSDDE8ijQJTr/h5y', 1),
(NULL, 'Per', 'Oransje', 'per@live.com', 0, '$2y$10$Su38sXMP2rjVWN7i8buoeOWm3g7N1n/w5g/cVgrU8mioFZgZVrH9i', 1),
(NULL, 'Steinar', 'Violet', 'steinar@live.com', 0, '$2y$10$IL5H0JmPiUHOpzJHlZEGLeK7n2Z7IYBK66/ed2MsLsdhSwvjNhaem', 1),
(NULL, 'Julie', 'Svart', 'julie@live.com', 0, '$2y$10$n3hhmlsFzkDzf5YoVLJ8NuL8KM9DbXoNvJP5ysQdqNNtq5ZyxHBgC', 1),
(NULL, 'Erik', 'Brun', 'erik@live.com', 0, '$2y$10$Rv19tbUaCA/u6jTDbTLpBeu4ohAtPsFJeP82HitaZEZikwkRpWInq', 1),
(NULL, 'Line', 'Gul', 'line@live.com', 0, '$2y$10$2TlNewweSiQQ1TEIiHiTIOOC61d3ki223S1qzOhQJbDnwvGvNN2vW', 1),
(NULL, 'Malin', 'Lilla', 'malin@live.com', 0, '$2y$10$Mdi7Xrscu5wAQxLBYX8c9uDwWC7TN2av1fXzdQ7ApBdgwGqAPgoHW', 1),
(NULL, 'Sara', 'Rød', 'sara@live.com', 0, '$2y$10$c6U5BGQHoacAz5MDb0r4YufFUFT3pYEVTlWKsuK0XPQS6EsTNoCWi', 1),
(NULL, 'Fredrik', 'Grønn', 'fredrik@live.com', 0, '$2y$10$nKQSSL1q1OSAz9NANahKMOssXnsOyp7CrZ8c1mP4U8PIXETbkx8ey', 1),
(NULL, 'Olaug', 'Olsen', 'olaug@live.com', 1, '$2y$10$ZxltDDmNihSKfQ.6f1kIpuqOzgsamrWM8WWPHAp2RR9CvI12TNG9m', 1),
(NULL, 'Ina', 'Fredriksen', 'ina@live.com', 1, '$2y$10$dHr/Rxl5Cm/x2dAo8BsYxuy.2rQau/HtXxOf.eWEeoC71HqB1mGeS', 1),
(NULL, 'Trine', 'Larsen', 'trine@live.com', 1, '$2y$10$j4CgC4zRuXS.HBZyxG3ou.VwH1sqRXLqC917CXdv2PAcvdCwLaAtW', 1),
(NULL, 'Truls', 'Gregersen', 'truls@live.com', 1, '$2y$10$2w1FrH1rqgEqk1b/feicjuxgnYH/xPWxBZqkvbQ4k69smHzLVgCi.', 1),
(NULL, 'Knut', 'Buskhaug', 'knut@live.com', 1, '$2y$10$7Rc3aDmXShAN9uKd7uMid.eqf/EJzDP13oWVaZLAwmBqCD9Bsal96', 1),
(NULL, 'Sindre', 'Arnhaug', 'sindre@live.com', 1, '$2y$10$PL6k.IQcOOPkNSM6bJBcZ.pPOtnxIr2Qu0P6ZusLOQPytYcH7d8Ci', 1),
(NULL, 'Miranda', 'Rasmussen', 'miranda@live.com', 1, '$2y$10$jR55Wxcs3Fba9ovAC9SjBuS1TcZZorXaKn.X.BBMFj7FEFxlN79t6', 1),
(NULL, 'Eirin', 'Løke', 'eirin@live.com', 1, '$2y$10$H7tzoTl4ZoY396DE0tVShefGQTPjDIGQ15xbfDi3ywSohLLVMETIe', 1),
(NULL, 'Vidar', 'Horn', 'vidar@live.com', 1, '$2y$10$ioymdEVgC26F0kNAwCtPkeNu0Qrai6Q5xu60363HiSkZfdCnxoHh.', 1),
(NULL, 'Ole', 'Nordmann', 'ole@live.com', 1, '$2y$10$Xvb6OD2ZQOIuYGhvvXzhNOJ2XGenCjLIB4iw.nmqmnyPa2oZ.Iena', 1);

INSERT INTO `courses` (`CourseID`, `CourseCode`, `CourseName`) VALUES
(NULL, 'IS-115', 'PHP'),
(NULL, 'IS-100', 'Multimedia'),
(NULL, 'IS-110', 'Geografi'),
(NULL, 'IS-210', 'Kjemi'),
(NULL, 'IS-222', 'Operativsystem'),
(NULL, 'IS-300', 'Turing Maskiner'),
(NULL, 'IS-310', 'Praktisk Fysikk');

INSERT INTO `courseaccess` (`CourseID`, `UserID`, `AsAssistant`) VALUES 
('1', '10', '1'),
('1', '15', '1'),
('2', '14', '1'),
('2', '11', '1'),
('3', '18', '1'),
('3', '17', '1'),
('4', '10', '1'),
('4', '15', '1'),
('5', '12', '1'),
('5', '18', '1'),
('6', '13', '1'),
('6', '14', '1'),
('7', '19', '1'),
('7', '16', '1'),
('1', '1', '0'),
('3', '1', '0'),
('4', '1', '0'),
('2', '2', '0'),
('3', '2', '0'),
('5', '2', '0'),
('1', '3', '0'),
('2', '3', '0'),
('3', '3', '0'),
('1', '4', '0'),
('6', '4', '0'),
('7', '4', '0'),
('5', '5', '0'),
('6', '5', '0'),
('7', '5', '0'),
('2', '6', '0'),
('3', '6', '0'),
('4', '6', '0'),
('5', '7', '0'),
('1', '7', '0'),
('4', '7', '0'),
('1', '8', '0'),
('3', '8', '0'),
('4', '8', '0'),
('1', '9', '0'),
('6', '9', '0'),
('7', '9', '0');

INSERT INTO `ProfileInfo` (`UserID`, `ProfileExperience`) VALUES 
('10','good at back end desgin and data handling , Experienced with organic  chemistry'),
('11','Good at video editing and sound effects'),
('12','Kernel developments expertise, worked on linux Kernels'),
('13','Broad experience with Turin Machines and theoretical computers'),
('14','Experienced with sound design and after effects, Knowledgable with Turing machines, especially pushdown systems'),
('15','Deep knowledge aroud operating system design and low level languages, Strong understanding of php compiling'),
('16','Knowledgable regarding practical real world uses of physics and realistic calculation frameworks'),
('17','Did research on the  Geo-economic history of Northern Europe and the effects of industrialisation on it'),
('18','Genral knowledge on European and Asian geography, Good understanding of operating systems theory'),
('19','practical physics stuff, knows things, seen things');


INSERT INTO `Availabilities` (`AvailabilityStart`, `AvailabilityEnd`, `AssistantID`) VALUES 
('2023-12-11 07:00:00','2023-12-11 16:00:00','10'),
('2023-12-12 07:00:00','2023-12-12 16:00:00','10');




