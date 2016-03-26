CREATE TABLE [customer](
'CustId'                TEXT NOT NULL PRIMARY KEY, 
'CustName'          TEXT,
'CustAddress'       TEXT,
'CustPhone'         TEXT,
'CustEmail'          TEXT
);

CREATE TABLE [menu_category](
  'CategoryId'          INTEGER NOT NULL PRIMARY KEY,
  'CategoryTitle'       TEXT,
  'CategoryImage'   TEXT,
  'Active'                  BOOLEAN,
  'Colour'                  TEXT );
  
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
  'CategoryId'              INTEGER,
  'RoomId'              INTEGER,
  'FbTypeId'              INTEGER);
  
  CREATE TABLE [table_category] (
  'TableCategoryId'       INTEGER NOT NULL PRIMARY KEY,
  'CategoryTitle'           TEXT,
  'Image'                       TEXT);
  
  CREATE TABLE [r_tables] (
  'TableId'                     INTEGER NOT NULL PRIMARY KEY,
  'TableNo'                     INTEGER,
  'TableCategoryId'         INTEGER,
  'Capacity'                    INTEGER,
  'IsOccupied'                  BOOLEAN);
  
  CREATE TABLE [orders] (
  'OrderId'             TEXT NOT NULL PRIMARY KEY,
  'OrderNo'             INTEGER,
  'CustId'                  TEXT,
  'OrderStatus'         BOOLEAN,
  'Orderdate'           DATE,
  'OrderTime'           TIME,
  'TableNo'                 INTEGER,
  'UserId'                  TEXT,
  'OrderAmount'         DOUBLE,
  'TakeawayNo'                 INTEGER,
  'OrderType'                 INTEGER);
  
  CREATE TABLE [order_details] (
  'OrderDetailsId'          INTEGER NOT NULL PRIMARY KEY,
  'OrderPrice'                  DOUBLE,
  'OrderQuantity'               INTEGER,
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
  'UserId'                  TEXT,
  'CustId'                  TEXT,
  'TableId'                 INTEGER,
  'IsPayed'                 BOOLEAN,
  'PayedBy'                 TEXT,
  'Discount'                INTEGER,
  'TakeawayNo'                 INTEGER);
  
  CREATE TABLE [bill_details] (
  'AutoId'                  INTEGER NOT NULL PRIMARY KEY,
  'OrderId'                 TEXT,
  'BillNo'                  INTEGER);
  
  CREATE TABLE [users] (
  'UserId'                  TEXT NOT NULL PRIMARY KEY,
  'UserName'            TEXT,
  'Password'            TEXT,
  'Active'                  BOOLEAN,
  'RoleId'                  INTEGER,
  'RestaurantId'        INTEGER,
  'Permissions'            TEXT);

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
 'LogoUrl'            TEXT,
 'Address'            TEXT,
 'Area'               TEXT,
 'City'               TEXT,
 'Country'               TEXT,
 'Phone'               TEXT,
 'Footer'               TEXT
);

 CREATE TABLE [takeaway_source] (
  'SourceId'            INTEGER NOT NULL PRIMARY KEY,
  'SourceName'          TEXT,
  'SourceImg'           TEXT,
  'Discount'            DOUBLE,
  'Active'              BOOLEAN);

CREATE TABLE [order_type](
 'OrderTypeId'    INTEGER PRIMARY KEY,
 'OrderTypeTitle'    TEXT,
'Active'              BOOLEAN);

CREATE TABLE [takeaway] (
  'TakeawayId'            TEXT NOT NULL PRIMARY KEY,
  'TakeawayNo'          INTEGER,
  'Discount'            DOUBLE,
  'DeliveryCharges'     DOUBLE,
  'CustId'              TEXT,
  'SourceId'            INTEGER,
  'UserId'            TEXT,
  'CreatedDate'       DATE);

CREATE TABLE [r_rooms](
 'RoomId'    INTEGER PRIMARY KEY,
 'Description'    TEXT,
'Active'              BOOLEAN);

CREATE TABLE [r_printers](
 'PrinterId'    INTEGER PRIMARY KEY,
 'IpAddress'    TEXT,
 'PrinterName'    TEXT,
 'ModelName'    TEXT,
 'Company'    TEXT,
 'MacAddress'    TEXT,
 'Active'       BOOLEAN);

CREATE TABLE [room_type](
 'RoomTypeId'    INTEGER PRIMARY KEY,
 'RoomType'    TEXT,
 'Active'              BOOLEAN);

CREATE TABLE [r_room_printer](
 'RoomId'    INTEGER PRIMARY KEY,
 'RoomTypeId'    INTEGER,
 'PrinterId'    INTEGER,
 'Description'    TEXT,
 'Active'         BOOLEAN);

CREATE TABLE [r_config_settings](
 'ConfigKey'    TEXT PRIMARY KEY,
 'ConfigValue'  TEXT);

CREATE TABLE [permission_set](
 'PermissionId'    INTEGER PRIMARY KEY,
 'PermissionKey'    TEXT,
 'Description'    TEXT,
 'Active'         BOOLEAN);

 CREATE TABLE [fb_types] (
  'FbTypeId'                       INTEGER NOT NULL PRIMARY KEY,
  'FbTypeName'                    TEXT);




   
   
   
