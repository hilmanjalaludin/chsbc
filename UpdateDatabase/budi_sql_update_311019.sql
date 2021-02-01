--tambahan loan_tearing 
ALTER TABLE "dbo"."t_gn_loan_tiering"
	ADD "Free_Interest" DECIMAL(16,3) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_loan_tiering', 'column', 'Free_Interest';

ALTER TABLE "dbo"."t_gn_customer"
	ADD "Flag_Pds" TINYINT NULL DEFAULT ((0));
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_customer', 'column', 'Flag_Pds';


-- Dumping structure for table hsbcp.t_gn_frm_cip
CREATE TABLE "t_gn_frm_cip" (
	"id" INT IDENTITY(0,1) PRIMARY KEY,
	"CustomerId" BIGINT NOT NULL,
	"Bank" VARCHAR(200) NULL DEFAULT (NULL),
	"Cardno" VARCHAR(200) NULL DEFAULT (NULL),
	"BankBranch" VARCHAR(200) NULL DEFAULT (NULL),
	"BenefAccount" VARCHAR(200) NULL DEFAULT (NULL),
	"Name" VARCHAR(200) NULL DEFAULT (NULL),
	"Custno" VARCHAR(200) NULL DEFAULT (NULL),
	"TransferAmount" VARCHAR(200) NULL DEFAULT (NULL),
	"Cbid" VARCHAR(200) NULL DEFAULT (NULL),
	"DobObc" VARCHAR(200) NULL DEFAULT (NULL),
	"HsbcName" VARCHAR(200) NULL DEFAULT (NULL),
	"LimitOtb" VARCHAR(200) NULL DEFAULT (NULL),
	"Cycle" VARCHAR(200) NULL DEFAULT (NULL),
	"BankType" VARCHAR(200) NULL DEFAULT (NULL),
	"Tenor" INT NULL DEFAULT (NULL),
	"AmountLogged" DECIMAL(18,0) NULL DEFAULT (NULL),
	"Fee" VARCHAR(200) NULL DEFAULT (NULL),
	"AuthorizationRemark" VARCHAR(200) NULL DEFAULT (NULL),
	"Card_Mu_Remark" VARCHAR(200) NULL DEFAULT (NULL),
	"NewBalance" VARCHAR(200) NULL DEFAULT (NULL),
	"MobilePhone" VARCHAR(50) NULL DEFAULT (NULL),
	"Urn" VARCHAR(200) NULL DEFAULT (NULL),
	"CardExpDate" VARCHAR(50) NULL DEFAULT (NULL),
	"Tier1" DECIMAL(18,0) NULL DEFAULT (NULL),
	"Tier2" DECIMAL(18,0) NULL DEFAULT (NULL),
	"Tier3" DECIMAL(18,0) NULL DEFAULT (NULL),
	"Tier4" DECIMAL(18,0) NULL DEFAULT (NULL),
	"CipType" VARCHAR(50) NULL DEFAULT (NULL),
	"AccNo" VARCHAR(200) NULL DEFAULT (NULL),
	"UpdateDate" DATETIME2(7) NULL DEFAULT (NULL),
	"CreateDate" DATETIME2(7) NULL DEFAULT (NULL),
	"CreateBy" INT NOT NULL,
	"Installment" DECIMAL(18,0) NULL DEFAULT (NULL),
	"AdminFee" DECIMAL(18,0) NULL DEFAULT (NULL),
	"DisburseAmount" DECIMAL(18,0) NULL DEFAULT (NULL),
	"Pilprotect" VARCHAR(100) NULL DEFAULT (NULL),
	"IncomeDocCollected" VARCHAR(100) NULL DEFAULT (NULL),
	"LoansVar" INT NULL DEFAULT ('0'),
	"IdTiering" INT NULL DEFAULT ('0'),
	"FreeInterest" DECIMAL(18,0) NULL DEFAULT (NULL),
	"Rate" VARCHAR(7) NULL DEFAULT (NULL)
);
