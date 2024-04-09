BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "UserQuote" (
	"RegisteredUser_ID"	INTEGER NOT NULL,
	"Quote_ID"	INTEGER NOT NULL,
	FOREIGN KEY("RegisteredUser_ID") REFERENCES "RegisteredUser"("RegisteredUser_ID"),
	FOREIGN KEY("Quote_ID") REFERENCES "Quote"("Quote_ID")
);
CREATE TABLE IF NOT EXISTS "Broker" (
	"Broker_ID"	INTEGER NOT NULL,
	"first_name"	TEXT NOT NULL,
	"last_name"	TEXT NOT NULL,
	"email"	TEXT NOT NULL,
	"phone_number"	INTEGER NOT NULL,
	"country"	TEXT NOT NULL,
	"city"	TEXT NOT NULL,
	"postcode"	TEXT NOT NULL,
	"password"	TEXT NOT NULL,
	"brokage_name"	TEXT NOT NULL,
	"broker_license_number"	INTEGER NOT NULL,
	"company_name"	TEXT NOT NULL,
	"company_registration_number"	INTEGER NOT NULL,
	"company_country"	TEXT NOT NULL,
	"company_county"	TEXT NOT NULL,
	PRIMARY KEY("Broker_ID" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "RegisteredUser" (
	"RegisteredUser_ID"	INTEGER NOT NULL,
	"Quote_ID"	INTEGER,
	"first_name"	TEXT NOT NULL,
	"last_name"	TEXT NOT NULL,
	"email"	TEXT NOT NULL,
	"phone_number"	INTEGER NOT NULL,
	"country"	TEXT NOT NULL,
	"county"	TEXT NOT NULL,
	"city"	TEXT NOT NULL,
	"postcode"	TEXT NOT NULL,
	"password"	TEXT NOT NULL,
	"annual_income"	BLOB NOT NULL,
	"additional_income_amount"	INTEGER NOT NULL,
	"mortgage_duration"	INTEGER NOT NULL,
	"total_balance"	INTEGER NOT NULL,
	"other_commitments"	BLOB NOT NULL,
	"monthly_spending_amounts"	INTEGER NOT NULL,
	"deposit_amounts"	INTEGER NOT NULL,
	"credit_score"	INTEGER NOT NULL,
	PRIMARY KEY("RegisteredUser_ID" AUTOINCREMENT),
	FOREIGN KEY("Quote_ID") REFERENCES "Quote"("Quote_ID")
);
CREATE TABLE IF NOT EXISTS "Product" (
	"Product_ID"	INTEGER NOT NULL,
	"Quote_ID"	INTEGER NOT NULL,
	"Broker_ID"	INTEGER NOT NULL,
	"image"	BLOB,
	"name"	TEXT NOT NULL,
	"descrition"	TEXT NOT NULL,
	"expected_income"	INTEGER NOT NULL,
	"expected_outgoings"	INTEGER NOT NULL,
	"expected_credit_score"	INTEGER NOT NULL,
	"expected_employment_type"	TEXT NOT NULL,
	PRIMARY KEY("Product_ID" AUTOINCREMENT),
	FOREIGN KEY("Broker_ID") REFERENCES "Broker"("Broker_ID"),
	FOREIGN KEY("Quote_ID") REFERENCES "Quote"("Quote_ID")
);
CREATE TABLE IF NOT EXISTS "Quote" (
	"Quote_ID"	INTEGER,
	"Product_ID"	INTEGER,
	"RegisteredUser_ID"	INTEGER,
	"name"	TEXT NOT NULL,
	"loan_amount"	INTEGER NOT NULL,
	"term"	INTEGER NOT NULL,
	"interest"	INTEGER NOT NULL,
	"rate"	INTEGER NOT NULL,
	"total"	INTEGER NOT NULL,
	"product_starred"	BLOB NOT NULL,
	PRIMARY KEY("Quote_ID" AUTOINCREMENT),
	FOREIGN KEY("Product_ID") REFERENCES "Product"("Product_ID"),
	FOREIGN KEY("RegisteredUser_ID") REFERENCES "RegisteredUser"("RegisteredUser_ID"),
	FOREIGN KEY("Quote_ID") REFERENCES "Quote"("Quote_ID")
);
INSERT INTO "Broker" VALUES (1,'Paul','Smith','paulsmith123@gmail.com',7222333444,'United Kingdom','Sheffield','S3 5VY','Broker!123','TradeVerse',456,'TradeWise',396,'United Kingdom','South Yorkshire');
INSERT INTO "Broker" VALUES (2,'','','',0,'','','','','',0,'',0,'','');
INSERT INTO "Broker" VALUES (3,'','','',0,'','','','','',0,'',0,'','');
INSERT INTO "RegisteredUser" VALUES (1,NULL,'Steve','Taylor','SteveTaylor@gmail.com',7333596372,'United Kingdom','South Yorkshire','Sheffield','S1 3ef','Pass123!','20000',500,20,25000,'TRUE',2000,500,500);
INSERT INTO "RegisteredUser" VALUES (2,NULL,'','','',0,'','','','','','',0,0,0,'',0,0,0);
INSERT INTO "Quote" VALUES (1,NULL,NULL,'QuoteName',25000,5000,2.5,3,30000,'FALSE');
INSERT INTO "Quote" VALUES (2,NULL,NULL,'',0,0,0,0,0,'');
COMMIT;
