CREATE TABLE [menu_category](
  'CategoryId' INTEGER NOT NULL PRIMARY KEY,
  'CategoryTitle' TEXT,
  'CategoryImage' TEXT,
  'Active' BOOLEAN,
  'CreatedDate' DATETIME,
  'UpdatedDate' DATETIME );
  
  CREATE TABLE [menu] (
  'MenuId' INTEGER NOT NULL PRIMARY KEY,
  'MenuTitle' TEXT,
  'Image' TEXT,
  'Price' DOUBLE,
  'Ingredients' TEXT,
  'Tags' TEXT,
  'AvailabilityStatus' BOOLEAN,
  'Active' BOOLEAN,
  'FoodType' BOOLEAN,
  'CreatedDate' DATETIME,
  'UpdatedDate' DATETIME,
  'CategoryId' INTEGER);
  
  CREATE TABLE [table_category] (
  'TableCategoryId' INTEGER NOT NULL PRIMARY KEY,
  'CategoryTitle' TEXT,
  'Image' TEXT,
  'CrearedDate' DATETIME,
  'UpdatedDate' DATETIME);
  
  CREATE TABLE [r_tables] (
  'TableNo' INTEGER NOT NULL PRIMARY KEY,
  'TableCategoryId' INTEGER,
  'Capacity' INTEGER,
  'CreatedDate' DATETIME,
  'UpdatedDate' DATETIME);
  
  CREATE TABLE [orders] (
  'OrderId' TEXT NOT NULL PRIMARY KEY,
  'OrderNo' INTEGER,
  'OrderStatus' BOOLEAN,
  'Orderdate' DATE,
  'OrderTime' TIME,
  'CreatedDate' DATETIME,
  'UpdatedDate' DATETIME,
  'TableNo' INTEGER,
  'UserId' INTEGER,
  'OrderAmount' DOUBLE);
  
  CREATE TABLE [order_details] (
  'OrderDetailsId' INTEGER NOT NULL PRIMARY KEY,
  'OrderPrice' DOUBLE,
  'OrderQuantity' INTEGER,
  'CreatedDate' DATETIME,
  'UpdatedDate' DATETIME,
  'OrderId' TEXT,
  'MenuId' INTEGER,
  'MenuTitle' TEXT);
  
  CREATE TABLE [menu_tags] (
  'TagId' INTEGER NOT NULL PRIMARY KEY,
  'TagTitle' TEXT);
  
  CREATE TABLE [bill] (
  'BillNo' INTEGER NOT NULL PRIMARY KEY,
  'BillDate' DATE,
  'BillTime' TIME,
  'NetAmount' DOUBLE,
  'TotalTaxAmount' DOUBLE,
  'TotalPayAmount' DOUBLE,
  'CreatedDate' DATETIME,
  'UpdatedDate' DATETIME,
  'UserId' INTEGER);
  
  CREATE TABLE [bill_details] (
  'AutoId' INTEGER NOT NULL PRIMARY KEY,
  'OrderId' TEXT,
  'BillNo' INTEGER,
  'CreatedDate' DATETIME,
  'UpdatedDate' DATETIME);
  
  CREATE TABLE [users] (
  'UserId' INTEGER NOT NULL PRIMARY KEY,
  'UserName' TEXT,
  'Password' TEXT,
  'Active' BOOLEAN,
  'CreatedDate' DATETIME,
  'UpadtedDate' DATETIME,
  'RoleId' INTEGER,
  'RestaurantId' INTEGER);






   
   
