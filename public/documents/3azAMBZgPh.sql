-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2018 at 09:50 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `managemyasset`
--

-- --------------------------------------------------------

--
-- Table structure for table `assetcodeid`
--

CREATE TABLE `assetcodeid` (
  `num` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assetcodeid`
--

INSERT INTO `assetcodeid` (`num`) VALUES
(0);

-- --------------------------------------------------------

--
-- Table structure for table `assetcomment`
--

CREATE TABLE `assetcomment` (
  `id` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `userID` int(11) NOT NULL,
  `dateComment` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assetnames`
--

CREATE TABLE `assetnames` (
  `uid` int(20) NOT NULL,
  `AssetName` varchar(100) NOT NULL,
  `createdBy` varchar(200) NOT NULL,
  `aUlocation` int(3) NOT NULL,
  `aUdepartment` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assetnames`
--

INSERT INTO `assetnames` (`uid`, `AssetName`, `createdBy`, `aUlocation`, `aUdepartment`) VALUES
(1, 'LVS LG AC', '286', 4, 1),
(2, 'LVSLGAC', '286', 4, 1),
(3, 'General H5200', '286', 5, 1),
(4, 'Somoto 1', '286', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `assetstwoweeksexpire`
--

CREATE TABLE `assetstwoweeksexpire` (
  `id` int(100) NOT NULL,
  `aid` int(100) NOT NULL,
  `purchasedDate` datetime NOT NULL,
  `expiryDate` datetime NOT NULL,
  `assignLocation` varchar(255) NOT NULL,
  `aDepartment` text NOT NULL,
  `sessID` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `type` enum('2','1') NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `asset_register`
--

CREATE TABLE `asset_register` (
  `id` int(10) NOT NULL,
  `AssetName` varchar(100) NOT NULL,
  `AssetCost` varchar(255) DEFAULT '0',
  `CurrencyType` varchar(6) NOT NULL,
  `VendorName` varchar(100) NOT NULL,
  `AssetDescription` text NOT NULL,
  `PurchaseDate` date NOT NULL,
  `ci_procureID` varchar(20) NOT NULL,
  `setupMTCschedule` varchar(40) NOT NULL,
  `dParts` text NOT NULL,
  `sDate` datetime DEFAULT NULL,
  `eDate` datetime DEFAULT NULL,
  `aType` varchar(200) NOT NULL,
  `aTypeName` varchar(20) NOT NULL,
  `aCategory` varchar(200) DEFAULT 'NULL',
  `aCategoryName` varchar(40) NOT NULL,
  `oldTag` varchar(20) NOT NULL,
  `assetTag` varchar(50) NOT NULL,
  `operatingOffice` text NOT NULL,
  `dRegistered` date NOT NULL,
  `allocated` enum('1','2') NOT NULL DEFAULT '2',
  `allocatedlastestuser` varchar(100) NOT NULL,
  `ownerEmail` varchar(10) NOT NULL,
  `admUserID` int(11) NOT NULL,
  `statusApproval` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1 = default 2 = upload',
  `disposedAsset` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0',
  `disposedStatus` enum('active','disposed','markfordisposal') NOT NULL DEFAULT 'active',
  `assignLocation` tinytext,
  `assignLocationName` varchar(60) NOT NULL,
  `aDepartment` text NOT NULL,
  `aDepartmentName` varchar(60) NOT NULL,
  `effectiveDate` date NOT NULL,
  `cap` varchar(20) NOT NULL,
  `class` varchar(255) DEFAULT NULL,
  `AssetUsermigration` varchar(255) NOT NULL,
  `defaultsStatusShow` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '''0'' - Default , ''1'' - ''Assigned''   ''2'' - Unassigned',
  `isMaintained` enum('0','1') NOT NULL DEFAULT '0',
  `subCategory` int(10) NOT NULL,
  `whichplace` enum('old','new','procurement','not-defined','account') NOT NULL DEFAULT 'not-defined',
  `whomarkfordisposalandispose` varchar(255) NOT NULL,
  `systemCheck` enum('active','vacant','stolen','obsolete','not-specified') NOT NULL DEFAULT 'not-specified',
  `auditTrail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `asset_tag`
--

CREATE TABLE `asset_tag` (
  `id` int(10) NOT NULL,
  `oldTag` varchar(20) NOT NULL,
  `availableTags` varchar(20) NOT NULL,
  `assignedStatus` enum('available','not-available') NOT NULL DEFAULT 'available',
  `sessionID` int(10) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `dept` varchar(5) NOT NULL,
  `dateInserted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class_maint`
--

CREATE TABLE `class_maint` (
  `id` int(20) NOT NULL,
  `className` varchar(255) NOT NULL,
  `sessionID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dailyreading`
--

CREATE TABLE `dailyreading` (
  `rid` int(255) NOT NULL,
  `assetid` int(255) NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `timeDiff` time NOT NULL,
  `startmeter` int(255) NOT NULL,
  `endmeter` int(255) NOT NULL,
  `sessID` varchar(255) NOT NULL,
  `dateRegistered` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `depreciationtable`
--

CREATE TABLE `depreciationtable` (
  `id` int(20) NOT NULL,
  `aid` int(20) NOT NULL,
  `aCat` varchar(10) NOT NULL,
  `UsefulLife` int(10) NOT NULL,
  `purchaseDate` date NOT NULL,
  `effectiveDate` date NOT NULL,
  `AssetCost` varchar(200) NOT NULL,
  `capitalizeValue` int(255) NOT NULL,
  `mid` int(90) NOT NULL,
  `usefuLifeCount` int(5) NOT NULL,
  `LifeCountwithinperiod` int(10) NOT NULL,
  `Depreciation` varchar(200) NOT NULL,
  `DepMonth` varchar(200) NOT NULL,
  `Depwithinperiod` varchar(100) NOT NULL,
  `AccumDepOpeingYearEnding` varchar(200) NOT NULL,
  `AccumulativeDep` varchar(200) NOT NULL,
  `capitalize` varchar(255) NOT NULL,
  `BookValue` varchar(200) NOT NULL,
  `runDate` int(5) NOT NULL,
  `dateRun` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `depreciationtablehistory`
--

CREATE TABLE `depreciationtablehistory` (
  `id` int(20) UNSIGNED NOT NULL,
  `dpID` int(20) NOT NULL,
  `aid` int(20) NOT NULL,
  `dh_aCat` int(10) NOT NULL,
  `userLife` varchar(10) NOT NULL,
  `purchaseDate` date NOT NULL,
  `effectiveDate` date NOT NULL,
  `AssetCost` varchar(200) NOT NULL,
  `capitalizeValue` int(255) NOT NULL,
  `mid` int(90) NOT NULL,
  `LifeCount` int(20) NOT NULL,
  `LifeCountwithinperiod` int(10) NOT NULL,
  `Depreciation` varchar(200) NOT NULL,
  `DepMonth` varchar(200) NOT NULL,
  `AccumDepOpeingYearEnding` varchar(200) NOT NULL,
  `AccumulativeDep` varchar(200) NOT NULL,
  `BookValue` varchar(200) NOT NULL,
  `hrunDate` int(3) NOT NULL,
  `dateRun` date NOT NULL,
  `statusRollBack` enum('0','1') NOT NULL DEFAULT '0' COMMENT '''0'' - Default , ''1'' means closed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `disposed_assets`
--

CREATE TABLE `disposed_assets` (
  `id` int(30) NOT NULL,
  `aid` int(50) NOT NULL,
  `aType` int(2) NOT NULL,
  `aCatID` int(2) NOT NULL,
  `aName` varchar(255) NOT NULL,
  `sellingPrice` int(20) NOT NULL,
  `cumdep` int(200) NOT NULL,
  `bv` int(200) NOT NULL,
  `dateDisposed` date NOT NULL,
  `disposedTo` varchar(255) NOT NULL,
  `dateRegistered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sessID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dispose_awaiting`
--

CREATE TABLE `dispose_awaiting` (
  `id` int(10) UNSIGNED NOT NULL,
  `aid` int(20) NOT NULL,
  `md5id` varchar(255) NOT NULL,
  `catID` int(5) NOT NULL,
  `reason` text NOT NULL,
  `maintanceCost` varchar(20) NOT NULL,
  `aCost` varchar(30) NOT NULL,
  `sessionID` varchar(30) NOT NULL,
  `assetTag` varchar(200) NOT NULL,
  `disposeValue` int(30) NOT NULL,
  `hod` varchar(60) NOT NULL,
  `Location` varchar(20) NOT NULL,
  `icu` int(5) NOT NULL,
  `treated` enum('0','1','2','3','4') NOT NULL DEFAULT '0',
  `dateRegistered` datetime NOT NULL,
  `hodwhoapprove` varchar(255) NOT NULL,
  `icuwhoapprove` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fm_allocate_asset`
--

CREATE TABLE `fm_allocate_asset` (
  `id` int(20) NOT NULL,
  `aid` int(30) NOT NULL,
  `assetName` varchar(30) NOT NULL,
  `User` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `department` text NOT NULL,
  `dateAllocated` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `dRegistered` datetime NOT NULL,
  `admUserID` int(11) NOT NULL,
  `confirmMove` int(2) NOT NULL,
  `whoismoving` varchar(255) NOT NULL,
  `mainDept` varchar(200) NOT NULL COMMENT 'The department where the asset is',
  `mainLocale` varchar(200) NOT NULL COMMENT 'The location is the asset is allocated from'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fm_asset_config_info`
--

CREATE TABLE `fm_asset_config_info` (
  `cid` int(200) NOT NULL,
  `assetID` int(255) NOT NULL,
  `stype` varchar(200) NOT NULL,
  `model` varchar(100) NOT NULL,
  `tag` varchar(60) NOT NULL,
  `sNumber` varchar(100) NOT NULL,
  `chNumber` varchar(60) NOT NULL,
  `opSystem` varchar(100) NOT NULL,
  `processor` varchar(200) NOT NULL,
  `disk` varchar(100) NOT NULL,
  `memory` varchar(100) NOT NULL,
  `as_key` varchar(100) NOT NULL,
  `version` varchar(100) NOT NULL,
  `capacity` varchar(100) NOT NULL,
  `others` varchar(100) NOT NULL,
  `microsoft` varchar(200) NOT NULL,
  `officeKey` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fm_capitalized`
--

CREATE TABLE `fm_capitalized` (
  `id` int(30) NOT NULL,
  `aid` int(255) NOT NULL,
  `mid` int(255) NOT NULL,
  `capitalizedCost` bigint(200) NOT NULL,
  `dateCap` datetime NOT NULL,
  `sessID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fm_menu`
--

CREATE TABLE `fm_menu` (
  `mid` int(90) NOT NULL,
  `mName` varchar(50) NOT NULL,
  `mLink` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fm_menu`
--

INSERT INTO `fm_menu` (`mid`, `mName`, `mLink`, `userid`) VALUES
(1, 'Dashboard', '', '80'),
(2, 'Purchased Asset', '', '80,286,75,284'),
(3, 'Maintenance', '', '80,286,284'),
(6, 'Set Priviledge', '', '80'),
(12, 'Asset Register', '', '80,286,284'),
(13, 'Allocation', '', '80,286,284'),
(14, 'Depreciation', '', '80,284'),
(15, 'Setup', '', '80'),
(16, 'Mark for Disposal', '', '80,286,284'),
(18, 'Requisition', '', '80,286'),
(20, 'Assign to location', '', '80,284'),
(21, 'Add New', '', '80,286,284'),
(22, 'Asset with book value', '', '80'),
(23, 'Assets with Cummulative Dep Value', '', '80'),
(24, 'Disposed Assets', '', '80,286'),
(25, 'Asset Maintenance History', '', '80,286,284'),
(26, 'Job Order', '', '80,286'),
(27, 'Disposal Approval', '', '80'),
(28, 'Asset Category', '', '80');

-- --------------------------------------------------------

--
-- Table structure for table `fm_mvtolocation`
--

CREATE TABLE `fm_mvtolocation` (
  `id` int(90) NOT NULL,
  `assetTag` varchar(20) NOT NULL,
  `aid` int(50) NOT NULL,
  `sessID` int(20) NOT NULL,
  `fm_fromLocation` varchar(255) NOT NULL,
  `fm_toLocation` varchar(255) NOT NULL,
  `re_department` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL,
  `dateMoved` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fm_partsused`
--

CREATE TABLE `fm_partsused` (
  `id` int(20) NOT NULL,
  `mid` int(40) NOT NULL,
  `aid` int(50) NOT NULL,
  `invoicedetails` text NOT NULL,
  `mcost` int(20) NOT NULL,
  `sessID` int(11) NOT NULL,
  `dRegistered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

CREATE TABLE `insurance` (
  `id` int(10) NOT NULL,
  `insurancepoliy` text NOT NULL,
  `from_in` date NOT NULL,
  `to_in` date NOT NULL,
  `assetid` int(30) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lastmonthdep`
--

CREATE TABLE `lastmonthdep` (
  `id` int(11) NOT NULL,
  `openMonthDate` int(4) NOT NULL,
  `status` int(2) NOT NULL,
  `catdegory` int(2) NOT NULL,
  `hasbenrun` enum('yes','no','pending') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_assets`
--

CREATE TABLE `maintenance_assets` (
  `id` int(30) NOT NULL,
  `md5ID` varchar(200) NOT NULL,
  `aid` varchar(255) NOT NULL,
  `invoiceID` int(10) NOT NULL,
  `maCat` int(10) NOT NULL,
  `msubCat` int(10) NOT NULL,
  `parts` text NOT NULL,
  `vendorName` varchar(255) NOT NULL,
  `approveVendorID` int(10) NOT NULL,
  `warrantyreason` text NOT NULL,
  `dreasonID` int(20) NOT NULL,
  `scheduleDate` date NOT NULL,
  `estimatedCost` int(50) NOT NULL,
  `qty` int(10) NOT NULL,
  `actualCost` int(50) DEFAULT NULL,
  `approvedCost` varchar(20) NOT NULL,
  `recommendation` text NOT NULL,
  `note` tinytext NOT NULL,
  `dRegistered` date NOT NULL,
  `refNo` varchar(20) NOT NULL,
  `invNum` varchar(20) NOT NULL,
  `invDate` date NOT NULL,
  `sessID` int(10) NOT NULL,
  `assetLocation` varchar(255) NOT NULL,
  `aDepartment` varchar(255) NOT NULL,
  `approve` enum('0','1','2','3','4','5','6','7','8','9','10','11','12','13') NOT NULL DEFAULT '0' COMMENT '0 - sent for approval 1 - HOD approves JO 2- HOD rejects JO 4- Requisition Awaiting Approval 5 - HOD approves Requesting 7 - HOD rejects Requesition  6 - ICU approves requisition  8 - ICU rejects requisition  10 - Cheque Ready (account approves)  11 - Paid to Vendor  12 - Closed',
  `approveBy` varchar(20) NOT NULL,
  `secondLevelapproval` int(10) NOT NULL,
  `verifiedBy` int(10) NOT NULL,
  `imgUrl` text NOT NULL,
  `cheque` text NOT NULL,
  `hodEmail` varchar(255) NOT NULL,
  `createdbyEmail` varchar(255) NOT NULL,
  `createdByID` int(10) NOT NULL,
  `dicusgroup` varchar(10) NOT NULL,
  `requsitionHod` varchar(200) NOT NULL,
  `daccountgroup` varchar(10) NOT NULL,
  `exCode` varchar(90) NOT NULL,
  `closed` enum('0','1') NOT NULL DEFAULT '0',
  `refID` int(10) NOT NULL,
  `mdisposedAsset` enum('active','disposed','pending') NOT NULL DEFAULT 'active',
  `expenseproID` int(100) NOT NULL,
  `dateApproved` datetime NOT NULL,
  `auditTrail` text NOT NULL,
  `comments` text NOT NULL,
  `sageRef` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maint_vend`
--

CREATE TABLE `maint_vend` (
  `id` int(10) NOT NULL,
  `aid` int(20) NOT NULL,
  `vendorA` varchar(255) NOT NULL,
  `vendorAprice` int(200) NOT NULL,
  `vendorB` varchar(255) NOT NULL,
  `vendorBprice` int(200) NOT NULL,
  `vendorC` varchar(255) NOT NULL,
  `vendorCprice` int(200) NOT NULL,
  `vendorFileA` varchar(100) NOT NULL,
  `vendorFileB` varchar(100) NOT NULL,
  `vendorFileC` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `newpopupalert`
--

CREATE TABLE `newpopupalert` (
  `id` int(20) NOT NULL,
  `asid` int(20) NOT NULL,
  `maintenanceDate` date NOT NULL,
  `totalValueReminder` int(20) NOT NULL,
  `endValueReminder` int(10) NOT NULL,
  `dailyreadings` time NOT NULL DEFAULT '00:00:00',
  `meterReading` int(10) NOT NULL,
  `dCounter` int(10) NOT NULL,
  `getclass` varchar(200) NOT NULL,
  `userid` varchar(40) NOT NULL,
  `location` varchar(40) NOT NULL,
  `department` varchar(150) NOT NULL,
  `status` int(1) NOT NULL,
  `type` enum('1','2') NOT NULL DEFAULT '2',
  `hod` varchar(255) NOT NULL,
  `gm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `perodclassetup`
--

CREATE TABLE `perodclassetup` (
  `id` int(20) NOT NULL,
  `className` varchar(255) NOT NULL,
  `classID` varchar(10) NOT NULL,
  `days` varchar(10) NOT NULL,
  `timeset` varchar(10) NOT NULL,
  `endDate` varchar(10) NOT NULL,
  `hod` varchar(255) NOT NULL,
  `gm` varchar(255) NOT NULL,
  `alertLocation` varchar(30) NOT NULL,
  `alertUnit` varchar(30) NOT NULL,
  `addedBy` varchar(50) NOT NULL,
  `dateAdded` datetime NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setupasset`
--

CREATE TABLE `setupasset` (
  `id` int(30) NOT NULL,
  `aid` int(20) NOT NULL,
  `cip` varchar(20) NOT NULL,
  `sDate` datetime NOT NULL,
  `eDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(10) NOT NULL,
  `subcatName` varchar(255) NOT NULL,
  `addBy` varchar(255) NOT NULL,
  `uLoction` int(5) NOT NULL,
  `uDepartment` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `vendorName` varchar(255) NOT NULL,
  `sessID` int(11) NOT NULL,
  `phone` varchar(19) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `addebyUnit` varchar(200) NOT NULL,
  `dateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assetcomment`
--
ALTER TABLE `assetcomment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assetnames`
--
ALTER TABLE `assetnames`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `AssetName` (`AssetName`);

--
-- Indexes for table `assetstwoweeksexpire`
--
ALTER TABLE `assetstwoweeksexpire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_register`
--
ALTER TABLE `asset_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_tag`
--
ALTER TABLE `asset_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_maint`
--
ALTER TABLE `class_maint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dailyreading`
--
ALTER TABLE `dailyreading`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `depreciationtable`
--
ALTER TABLE `depreciationtable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depreciationtablehistory`
--
ALTER TABLE `depreciationtablehistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disposed_assets`
--
ALTER TABLE `disposed_assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dispose_awaiting`
--
ALTER TABLE `dispose_awaiting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fm_allocate_asset`
--
ALTER TABLE `fm_allocate_asset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fm_asset_config_info`
--
ALTER TABLE `fm_asset_config_info`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `asset` (`assetID`);

--
-- Indexes for table `fm_capitalized`
--
ALTER TABLE `fm_capitalized`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fm_menu`
--
ALTER TABLE `fm_menu`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `fm_mvtolocation`
--
ALTER TABLE `fm_mvtolocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fm_partsused`
--
ALTER TABLE `fm_partsused`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insurance`
--
ALTER TABLE `insurance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lastmonthdep`
--
ALTER TABLE `lastmonthdep`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenance_assets`
--
ALTER TABLE `maintenance_assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maint_vend`
--
ALTER TABLE `maint_vend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newpopupalert`
--
ALTER TABLE `newpopupalert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perodclassetup`
--
ALTER TABLE `perodclassetup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setupasset`
--
ALTER TABLE `setupasset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assetcomment`
--
ALTER TABLE `assetcomment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assetnames`
--
ALTER TABLE `assetnames`
  MODIFY `uid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `assetstwoweeksexpire`
--
ALTER TABLE `assetstwoweeksexpire`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_register`
--
ALTER TABLE `asset_register`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_tag`
--
ALTER TABLE `asset_tag`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class_maint`
--
ALTER TABLE `class_maint`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dailyreading`
--
ALTER TABLE `dailyreading`
  MODIFY `rid` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `depreciationtable`
--
ALTER TABLE `depreciationtable`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `depreciationtablehistory`
--
ALTER TABLE `depreciationtablehistory`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disposed_assets`
--
ALTER TABLE `disposed_assets`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dispose_awaiting`
--
ALTER TABLE `dispose_awaiting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fm_allocate_asset`
--
ALTER TABLE `fm_allocate_asset`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fm_asset_config_info`
--
ALTER TABLE `fm_asset_config_info`
  MODIFY `cid` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fm_capitalized`
--
ALTER TABLE `fm_capitalized`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fm_menu`
--
ALTER TABLE `fm_menu`
  MODIFY `mid` int(90) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `fm_mvtolocation`
--
ALTER TABLE `fm_mvtolocation`
  MODIFY `id` int(90) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fm_partsused`
--
ALTER TABLE `fm_partsused`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `insurance`
--
ALTER TABLE `insurance`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lastmonthdep`
--
ALTER TABLE `lastmonthdep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenance_assets`
--
ALTER TABLE `maintenance_assets`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maint_vend`
--
ALTER TABLE `maint_vend`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newpopupalert`
--
ALTER TABLE `newpopupalert`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perodclassetup`
--
ALTER TABLE `perodclassetup`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setupasset`
--
ALTER TABLE `setupasset`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
