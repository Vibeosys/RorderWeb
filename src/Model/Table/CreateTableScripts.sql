CREATE TABLE [customer](
'CustId'                TEXT NOT NULL PRIMARY KEY, 
'CustName'          TEXT,
'CustPhone'         TEXT,
'CustEmail'          TEXT
);

CREATE TABLE [menu_category](
  'CategoryId'          INTEGER NOT NULL PRIMARY KEY,
  'CategoryTitle'       TEXT,
  'CategoryImage'   TEXT,
  'Active'                  BOOLEAN,
  'Colour'                  TEXT,
  'CreatedDate'         DATETIME,
  'UpdatedDate'         DATETIME );
  
  CREATE TABLE [menu] (
  'MenuId'                  INTEGER NOT NULL PRIMARY KEY,
  'MenuTitle'               TEXT,
  'Image'                       TEXT,
  'Price'                       DOUBLE,
  'Ingredients'             TEXT,
  'Tags'                        TEXT,
  'AvailabilityStatus'      BOOLEAN,
  'Active'                      BOOLEAN,
  'FoodType'                BOOLEAN,
  'IsSpicy'                     BOOLEAN,
  'CreatedDate'             DATETIME,
  'UpdatedDate'             DATETIME,
  'CategoryId'              INTEGER);
  
  CREATE TABLE [table_category] (
  'TableCategoryId'       INTEGER NOT NULL PRIMARY KEY,
  'CategoryTitle'           TEXT,
  'Image'                       TEXT,
  'CreatedDate'             DATETIME,
  'UpdatedDate'             DATETIME);
  
  CREATE TABLE [r_tables] (
  'TableId'                     INTEGER NOT NULL PRIMARY KEY,
  'TableNo'                     INTEGER,
  'TableCategoryId'         INTEGER,
  'Capacity'                    INTEGER,
  'IsOccupied'                  BOOLEAN,
  'CreatedDate'                 DATETIME,
  'UpdatedDate'                 DATETIME);
  
  CREATE TABLE [orders] (
  'OrderId'             TEXT NOT NULL PRIMARY KEY,
  'OrderNo'             INTEGER,
  'CustId'                  TEXT,
  'OrderStatus'         BOOLEAN,
  'Orderdate'           DATE,
  'OrderTime'           TIME,
  'CreatedDate'         DATETIME,
  'UpdatedDate'         DATETIME,
  'TableNo'                 INTEGER,
  'UserId'                  TEXT,
  'OrderAmount'         DOUBLE);
  
  CREATE TABLE [order_details] (
  'OrderDetailsId'          INTEGER NOT NULL PRIMARY KEY,
  'OrderPrice'                  DOUBLE,
  'OrderQuantity'               INTEGER,
  'CreatedDate'                 DATETIME,
  'UpdatedDate'                 DATETIME,
  'OrderId'                         TEXT,
  'MenuId'                          INTEGER,
  'MenuTitle'                       TEXT,
  'Note'                 TEXT);
  
  CREATE TABLE [menu_tags] (
  'TagId'                       INTEGER NOT NULL PRIMARY KEY,
  'TagTitle'                    TEXT);
  
  CREATE TABLE [bill] (
  'BillNo'                  INTEGER NOT NULL PRIMARY KEY,
  'BillDate'                DATE,
  'BillTime'                TIME,
  'NetAmount'            DOUBLE,
  'TotalTaxAmount'      DOUBLE,
  'TotalPayAmount'      DOUBLE,
  'CreatedDate'             DATETIME,
  'UpdatedDate'             DATETIME,
  'UserId'                  TEXT,
  'CustId'                  TEXT,
  'TableId'                 INTEGER,
  'IsPayed'                 BOOLEAN,
  'PayedBy'                 TEXT);
  
  CREATE TABLE [bill_details] (
  'AutoId'                  INTEGER NOT NULL PRIMARY KEY,
  'OrderId'                 TEXT,
  'BillNo'                  INTEGER,
  'CreatedDate'             DATETIME,
  'UpdatedDate'             DATETIME);
  
  CREATE TABLE [users] (
  'UserId'                  TEXT NOT NULL PRIMARY KEY,
  'UserName'            TEXT,
  'Password'            TEXT,
  'Active'                  BOOLEAN,
  'CreatedDate'             DATETIME,
  'UpdatedDate'             DATETIME,
  'RoleId'                  INTEGER,
  'RestaurantId'        INTEGER);

  CREATE TABLE [sync](
 'SyncAutoNo'           INTEGER PRIMARY KEY AUTOINCREMENT,
 'UserId'                   TEXT NOT NULL,
 'JsonSync'                 TEXT NOT NULL,
 'TableName'            TEXT NOT NULL); 

CREATE TABLE [temp_order](
 'TempOrderId'          INTEGER PRIMARY KEY AUTOINCREMENT,
 'CustId'                       TEXT,
 'TableId'                      INTEGER NOT NULL,
 'TableNo'                  INTEGER NOT NULL,
 'MenuId'                   INTEGER NOT NULL,
 'Quantity'                 INTEGER NOT NULL,
 'Note'                 TEXT,
 'OrderDate'                INTEGER NOT NULL,
 'OrderTime'                INTEGER NOT NULL,
 'OrderStatus'              INTEGER NOT NULL);

CREATE TABLE [table_transaction](
 'TableId'          INTEGER,
 'UserId'           TEXT,
 'CustId'           TEXT UNIQUE PRIMARY KEY,
 'IsWaiting'      BOOLEAN,
 'ArrivalTime'       DATETIME,
 'Occupancy'        INTEGER
);

CREATE TABLE [payment_mode_master](
 'PaymentModeId'    INTEGER PRIMARY KEY,
 'PaymentModeTitle'    TEXT,
 'Active'           BOOLEAN
);

CREATE TABLE [feedback_master](
 'FeedbackId'    INTEGER PRIMARY KEY,
 'FeedbackTitle'    TEXT,
 'Active'           BOOLEAN
);

CREATE TABLE [menu_note_master](
 'NoteId'    INTEGER PRIMARY KEY,
 'NoteTitle'    TEXT,
 'Active'           BOOLEAN
);
CREATE TABLE [restaurant](
 'RestaurantId'    INTEGER PRIMARY KEY,
 'RestaurantTitle'    TEXT,
 'LogoUrl'            TEXT
);



   
   
   
