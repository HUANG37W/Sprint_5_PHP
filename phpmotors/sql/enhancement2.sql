-- Query 1
INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, clientLevel, comment) 
VALUES ('Tony', 'Stack', 'tony@starkent.com', 'IamIronM@n', 1, 'I am the real Ironman');


-- Query 2
UPDATE clients
SET clientLevel = 3
WHERE clientId = 3

-- Query 3
UPDATE inventory
SET invDescription = replace(invDescription, 'small', 'spacious')
WHERE invId = 12

-- Query 4
SELECT invModel, classificationName 
FROM inventory
INNER JOIN carclassification
ON inventory.classificationId = carclassification.classificationId
WHERE classificationName = 'SUV'

-- Query 5
DELETE FROM inventory WHERE invId = 1;

-- Query 6 
UPDATE inventory
SET invImage = CONCAT("/phpmotors", invImage), invThumbnail=CONCAT("/phpmotors", invThumbnail)