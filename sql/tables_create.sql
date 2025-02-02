  -- tracks changes in the database.
  CREATE TABLE
  `audit` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `rowID` int unsigned DEFAULT NULL,
    `tableName` varchar(64) NOT NULL,
    `columnName` varchar(64) NOT NULL,
    `oldData` text,
    `newData` text NOT NULL,
    `auditTimestamp` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;


  -- dataOrganizations own websites (eg, business A could own several websites and have access to them, without business B accessing business A's websites or entity records)
  CREATE TABLE
  `dataOrganizations` (
    `dataOrganizationID` int unsigned NOT NULL AUTO_INCREMENT,
    `description` varchar(255) NOT NULL,
    PRIMARY KEY (`dataOrganizationID`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;


  -- an entity record is a BIGINT identity assigned to every "entity" type record... meaning it is a record that is accessible through the online console via an RTID/XID combination to identify it (see recordTypes)
  -- each entityRecord has an RTID (recordType), XID (the identity of that record type e.g userID); they also have websiteID and dataOrganizationID to restrict access to the data owners (dataOrganizations)
  CREATE TABLE
  `entityRecords` (
    `ERID` bigint unsigned NOT NULL AUTO_INCREMENT,
    `RTID` int unsigned NOT NULL COMMENT 'recordTypeID (what type of record)',
    `XID` bigint unsigned NOT NULL COMMENT 'table identity for the record.. eg userID',
    `websiteID` int unsigned NOT NULL COMMENT 'what website the record belongs to',
    `dataOrganizationID` int unsigned NOT NULL COMMENT 'what dataOrg the record belongs to',
    PRIMARY KEY (`ERID`),
    KEY `FK_entityRecords_recordTypeID` (`RTID`),
    KEY `FK_entityRecords_websiteID` (`websiteID`),
    KEY `FK_entityRecords_dataOrganizationID` (`dataOrganizationID`),
    CONSTRAINT `FK_entityRecords_dataOrganizationID` FOREIGN KEY (`dataOrganizationID`) REFERENCES `dataOrganizations` (`dataOrganizationID`),
    CONSTRAINT `FK_entityRecords_recordTypeID` FOREIGN KEY (`RTID`) REFERENCES `recordTypes` (`RTID`),
    CONSTRAINT `FK_entityRecords_websiteID` FOREIGN KEY (`websiteID`) REFERENCES `websites` (`websiteID`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;


  -- types of records that can be accessed through the online console via an RTID/XID combination.
  CREATE TABLE
  `recordTypes` (
    `RTID` int unsigned NOT NULL AUTO_INCREMENT,
    `description` varchar(255) NOT NULL COMMENT 'E.g user, record type, purchase order, etc',
    `tableName` varchar(255) DEFAULT NULL,
    `tableTag` varchar(3) NOT NULL COMMENT 'E.g USR, RT, PO',
    `primaryKey` varchar(64) NOT NULL,
    `inSearchIndex` bit(1) NOT NULL DEFAULT b'0' COMMENT 'Should this record type appear in master search?',
    `searchRankFactor` float NOT NULL DEFAULT '0.5' COMMENT 'Should master search rank items of this type higher or lower than others? .5 is default with 1 being show at top and 0 being show at bottom',
    `iconURL` varchar(2048) DEFAULT NULL COMMENT 'A generic icon representing this record type.',
    PRIMARY KEY (`RTID`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;


  -- websites created by a dataOrganization ... also how data is compartmentalized
  CREATE TABLE
  `websites` (
    `websiteID` int unsigned NOT NULL AUTO_INCREMENT,
    `parentWebsiteID` int unsigned DEFAULT NULL,
    `dataOrganizationID` int unsigned DEFAULT NULL,
    `description` varchar(255) NOT NULL COMMENT 'Website name',
    `cookieTag` varchar(6) DEFAULT NULL,
    `URL` varchar(80) NOT NULL COMMENT 'sub.domain.uld',
    PRIMARY KEY (`websiteID`),
    KEY `FK_websites_dataOrganizationID` (`dataOrganizationID`),
    KEY `FK_website_parentWebsiteID` (`parentWebsiteID`),
    CONSTRAINT `FK_website_parentWebsiteID` FOREIGN KEY (`parentWebsiteID`) REFERENCES `websites` (`websiteID`),
    CONSTRAINT `FK_websites_dataOrganizationID` FOREIGN KEY (`dataOrganizationID`) REFERENCES `dataOrganizations` (`dataOrganizationID`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
