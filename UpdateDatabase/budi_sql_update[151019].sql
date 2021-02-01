-- t_gn_campaign :
INSERT INTO "t_gn_campaign" ("CampaignId", "CampaignTypeId", "CampaignCode", "CampaignDesc", "BuildTypeId", "CategoryId", "CignaCampTypeId", "CignaSystemId", "ReUploadReasonId", "CampaignNumber", "CampaignName", "CampaignStartDate", "CampaignEndDate", "CampaignExtendedDate", "CampaignReUploadFlag", "CampaignDataFileName", "CampaignStatusFlag", "CampaignRowData", "CampaignIsFollowUp", "OutboundGoalsId", "DirectMethod", "DirectAction", "DID", "AvailCampaignId", "PaymentTypeId", "CampaignTemplate") VALUES (16, NULL, 'PORTOF010', 'CIP DORMANT', NULL, NULL, NULL, NULL, NULL, '1600010   ', 'CIP DORMANT', '2019-10-15 10:42:41.0000000', '2019-10-15 10:42:43.0000000', NULL, 0, NULL, 1, 0, 0, 2, 0, 0, 0, 0, NULL, NULL);
INSERT INTO "t_gn_campaign" ("CampaignId", "CampaignTypeId", "CampaignCode", "CampaignDesc", "BuildTypeId", "CategoryId", "CignaCampTypeId", "CignaSystemId", "ReUploadReasonId", "CampaignNumber", "CampaignName", "CampaignStartDate", "CampaignEndDate", "CampaignExtendedDate", "CampaignReUploadFlag", "CampaignDataFileName", "CampaignStatusFlag", "CampaignRowData", "CampaignIsFollowUp", "OutboundGoalsId", "DirectMethod", "DirectAction", "DID", "AvailCampaignId", "PaymentTypeId", "CampaignTemplate") VALUES (17, NULL, 'PORTOF011', 'CIP SPC', NULL, NULL, NULL, NULL, NULL, 'PORTOF011 ', 'CIP SPC', '2019-10-15 10:57:17.0000000', '2019-10-15 10:57:18.0000000', NULL, 0, NULL, 1, 0, 0, 2, 0, 0, 0, 0, NULL, NULL);
INSERT INTO "t_gn_campaign" ("CampaignId", "CampaignTypeId", "CampaignCode", "CampaignDesc", "BuildTypeId", "CategoryId", "CignaCampTypeId", "CignaSystemId", "ReUploadReasonId", "CampaignNumber", "CampaignName", "CampaignStartDate", "CampaignEndDate", "CampaignExtendedDate", "CampaignReUploadFlag", "CampaignDataFileName", "CampaignStatusFlag", "CampaignRowData", "CampaignIsFollowUp", "OutboundGoalsId", "DirectMethod", "DirectAction", "DID", "AvailCampaignId", "PaymentTypeId", "CampaignTemplate") VALUES (20, NULL, 'PORTOF012', 'CIP MLT', NULL, NULL, NULL, NULL, NULL, 'PORTOF012 ', 'CIP MLT', '2019-10-15 10:58:40.0000000', '2019-10-15 10:58:44.0000000', NULL, 0, NULL, 1, 0, 0, 2, 0, 0, 0, 0, NULL, NULL);

-- t_gn_campaign_ref :
INSERT INTO "t_gn_campaign_ref" ("id", "CampaignId", "TemplateId", "TableDetail", "ViewVerification", "ViewProductInfo") VALUES (10, 16, 10, 't_gn_attr_cip_dormant', 'VerifikasiA', NULL);
INSERT INTO "t_gn_campaign_ref" ("id", "CampaignId", "TemplateId", "TableDetail", "ViewVerification", "ViewProductInfo") VALUES (11, 17, 11, 't_gn_attr_cip_spc', 'VerifikasiA', NULL);
INSERT INTO "t_gn_campaign_ref" ("id", "CampaignId", "TemplateId", "TableDetail", "ViewVerification", "ViewProductInfo") VALUES (12, 20, 12, 't_gn_attr_cip_mlt', 'VerifikasiA', NULL);

-- t_gn_attr_cip_spc : perbaikan struktur table, id auto increment
CREATE TABLE "t_gn_attr_cip_spc" (
	"id" INT IDENTITY(1,1) PRIMARY KEY,
	"CustomerId" INT NOT NULL,
	"Cardno" VARCHAR(100) NULL DEFAULT (NULL),
	"accno" VARCHAR(100) NULL DEFAULT (NULL),
	"Name" VARCHAR(100) NULL DEFAULT (NULL),
	"DOB" VARCHAR(100) NULL DEFAULT (NULL),
	"Limit" VARCHAR(100) NULL DEFAULT (NULL),
	"balance" VARCHAR(100) NULL DEFAULT (NULL),
	"phone1" VARCHAR(100) NULL DEFAULT (NULL),
	"phone2" VARCHAR(100) NULL DEFAULT (NULL),
	"MOBILE" VARCHAR(100) NULL DEFAULT (NULL),
	"prod" VARCHAR(100) NULL DEFAULT (NULL),
	"cycle" VARCHAR(100) NULL DEFAULT (NULL),
	"UTILISATION" VARCHAR(100) NULL DEFAULT (NULL),
	"DUE_DATE" VARCHAR(100) NULL DEFAULT (NULL),
	"GENERATION_DT" VARCHAR(100) NULL DEFAULT (NULL),
	"Dbase_Expire_dt" VARCHAR(100) NULL DEFAULT (NULL),
	"card_expr_txt" VARCHAR(100) NULL DEFAULT (NULL),
	"addr1" VARCHAR(100) NULL DEFAULT (NULL),
	"addr2" VARCHAR(100) NULL DEFAULT (NULL),
	"addr3" VARCHAR(100) NULL DEFAULT (NULL),
	"addr4" VARCHAR(100) NULL DEFAULT (NULL),
	"zip" VARCHAR(100) NULL DEFAULT (NULL),
	"tier1" VARCHAR(100) NULL DEFAULT (NULL),
	"tier2" VARCHAR(100) NULL DEFAULT (NULL),
	"tier3" VARCHAR(100) NULL DEFAULT (NULL),
	"tier4" VARCHAR(100) NULL DEFAULT (NULL),
	"limit_band" VARCHAR(100) NULL DEFAULT (NULL),
	"refno" VARCHAR(100) NULL DEFAULT (NULL),
	"Tenor1" VARCHAR(100) NULL DEFAULT (NULL),
	"Rate1" VARCHAR(100) NULL DEFAULT (NULL),
	"Tenor2" VARCHAR(100) NULL DEFAULT (NULL),
	"Rate2" VARCHAR(100) NULL DEFAULT (NULL),
	"Tenor3" VARCHAR(100) NULL DEFAULT (NULL),
	"Rate3" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_06_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_06_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_06_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_06_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_12_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_12_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_12_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_12_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_18_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_18_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_18_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_18_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Start_Tele" VARCHAR(100) NULL DEFAULT (NULL),
	"End_Tele" VARCHAR(100) NULL DEFAULT (NULL),
	"CIP_TYPE" VARCHAR(100) NULL DEFAULT (NULL),
	"CUSTNO1" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T18_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T18_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T18_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T18_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T24_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T24_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T24_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T24_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T3_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T3_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T3_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T3_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_03_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_03_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_03_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_03_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Tenor4" VARCHAR(100) NULL DEFAULT (NULL),
	"Rate4" VARCHAR(100) NULL DEFAULT (NULL),
	"Sex" VARCHAR(100) NULL DEFAULT (NULL),
	"OCCUPATION" VARCHAR(100) NULL DEFAULT (NULL),
	"flag_supplement" VARCHAR(100) NULL DEFAULT (NULL),
	"Billing_Address" VARCHAR(100) NULL DEFAULT (NULL),
	"flag_bestbill" VARCHAR(100) NULL DEFAULT (NULL),
	"flag_area" VARCHAR(100) NULL DEFAULT (NULL),
	"propensity_CIP" VARCHAR(100) NULL DEFAULT (NULL),
	"Tenor5" VARCHAR(100) NULL DEFAULT (NULL),
	"Rate5" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_24_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_24_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_24_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_24_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T4_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T4_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T4_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T4_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Recsource" VARCHAR(100) NULL DEFAULT (NULL),
	"count_of_supplement" VARCHAR(100) NULL DEFAULT (NULL),
	"count_of_primary_card" VARCHAR(100) NULL DEFAULT (NULL),
	"Classic_card" VARCHAR(100) NULL DEFAULT (NULL),
	"Gold_card" VARCHAR(100) NULL DEFAULT (NULL),
	"Cashback_card" VARCHAR(100) NULL DEFAULT (NULL),
	"Platinum_card" VARCHAR(100) NULL DEFAULT (NULL),
	"Signature_card" VARCHAR(100) NULL DEFAULT (NULL),
	"Premier_card" VARCHAR(100) NULL DEFAULT (NULL),
);



-- t_gn_detail_tempalte : pill top up
UPDATE "hsbcp"."dbo"."t_gn_detail_template" SET "UploadColsName"='addr1', "UploadColsAlias"='addr1' 
WHERE  "Id"=593 AND "UploadTmpId"=6 AND "UploadColsName"='flag_change';

-- allow null :
ALTER TABLE "dbo"."t_gn_detail_template"
	ALTER COLUMN  "UploadKeys" VARCHAR(200) NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_detail_template', 'column', 'UploadKeys';

-- t_gn_detail_tempalte add record : pill top up
INSERT INTO "hsbcp"."dbo"."t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadColsAlias", "UploadColsOrder") VALUES ('6', 'addr2', 'addr2', '107');
INSERT INTO "hsbcp"."dbo"."t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadColsAlias", "UploadColsOrder") VALUES ('6', 'addr3', 'addr3', '108');
INSERT INTO "hsbcp"."dbo"."t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadColsAlias", "UploadColsOrder") VALUES ('6', 'addr4', 'addr4', '109');
INSERT INTO "hsbcp"."dbo"."t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadColsAlias", "UploadColsOrder") VALUES ('6', 'ZIP', 'ZIP', '110');
INSERT INTO "hsbcp"."dbo"."t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadColsAlias", "UploadColsOrder") VALUES ('6', 'HubID', 'HubID', '111');
INSERT INTO "hsbcp"."dbo"."t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadColsAlias", "UploadColsOrder") VALUES ('6', 'Flag_type', 'Flag_type', '112');
INSERT INTO "hsbcp"."dbo"."t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadColsAlias", "UploadColsOrder") VALUES ('6', 'HubID_V', 'HubID_V', '113');
INSERT INTO "hsbcp"."dbo"."t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadColsAlias", "UploadColsOrder") VALUES ('6', 'Need_Update_Income', 'Need_Update_Income', '114');
INSERT INTO "hsbcp"."dbo"."t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadColsAlias", "UploadColsOrder") VALUES ('6', 'Ever_CDD', 'Ever_CDD', '115');
INSERT INTO "hsbcp"."dbo"."t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadColsAlias", "UploadColsOrder") VALUES ('6', 'flag_supplement', 'flag_supplement', '116');
INSERT INTO "hsbcp"."dbo"."t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadColsAlias", "UploadColsOrder") VALUES ('6', 'count_of_supplement', 'count_of_supplement', '117');

-- t_gn_attr_pil_topup add field :
ALTER TABLE "dbo"."t_gn_attr_pil_topup"
	ADD "addr1" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_topup', 'column', 'addr1';
ALTER TABLE "dbo"."t_gn_attr_pil_topup"
	ADD "addr2" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_topup', 'column', 'addr2';
ALTER TABLE "dbo"."t_gn_attr_pil_topup"
	ADD "addr3" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_topup', 'column', 'addr3';
ALTER TABLE "dbo"."t_gn_attr_pil_topup"
	ADD "addr4" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_topup', 'column', 'addr4';
ALTER TABLE "dbo"."t_gn_attr_pil_topup"
	ADD "ZIP" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_topup', 'column', 'ZIP';
ALTER TABLE "dbo"."t_gn_attr_pil_topup"
	ADD "HubID" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_topup', 'column', 'HubID';
ALTER TABLE "dbo"."t_gn_attr_pil_topup"
	ADD "Flag_type" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_topup', 'column', 'Flag_type';
ALTER TABLE "dbo"."t_gn_attr_pil_topup"
	ADD "HubID_V" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_topup', 'column', 'HubID_V';
ALTER TABLE "dbo"."t_gn_attr_pil_topup"
	ADD "Need_Update_Income" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_topup', 'column', 'Need_Update_Income';
ALTER TABLE "dbo"."t_gn_attr_pil_topup"
	ADD "Ever_CDD" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_topup', 'column', 'Ever_CDD';
ALTER TABLE "dbo"."t_gn_attr_pil_topup"
	ADD "flag_supplement" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_topup', 'column', 'flag_supplement';
ALTER TABLE "dbo"."t_gn_attr_pil_topup"
	ADD "count_of_supplement" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_topup', 'column', 'count_of_supplement';

-- t_gn_attr_cip_mlt : perbaikan struktur table, id auto increment
CREATE TABLE "t_gn_attr_cip_mlt" (
	"id" INT IDENTITY(1,1) PRIMARY KEY,
	"CustomerId" INT NOT NULL,
	"Cardno" VARCHAR(100) NULL DEFAULT (NULL),
	"accno" VARCHAR(100) NULL DEFAULT (NULL),
	"Name" VARCHAR(100) NULL DEFAULT (NULL),
	"DOB" VARCHAR(100) NULL DEFAULT (NULL),
	"Limit" VARCHAR(100) NULL DEFAULT (NULL),
	"balance" VARCHAR(100) NULL DEFAULT (NULL),
	"phone1" VARCHAR(100) NULL DEFAULT (NULL),
	"phone2" VARCHAR(100) NULL DEFAULT (NULL),
	"MOBILE" VARCHAR(100) NULL DEFAULT (NULL),
	"prod" VARCHAR(100) NULL DEFAULT (NULL),
	"cycle" VARCHAR(100) NULL DEFAULT (NULL),
	"UTILISATION" VARCHAR(100) NULL DEFAULT (NULL),
	"DUE_DATE" VARCHAR(100) NULL DEFAULT (NULL),
	"GENERATION_DT" VARCHAR(100) NULL DEFAULT (NULL),
	"Dbase_Expire_dt" VARCHAR(100) NULL DEFAULT (NULL),
	"card_expr_txt" VARCHAR(100) NULL DEFAULT (NULL),
	"addr1" VARCHAR(100) NULL DEFAULT (NULL),
	"addr2" VARCHAR(100) NULL DEFAULT (NULL),
	"addr3" VARCHAR(100) NULL DEFAULT (NULL),
	"addr4" VARCHAR(100) NULL DEFAULT (NULL),
	"zip" VARCHAR(100) NULL DEFAULT (NULL),
	"tier1" VARCHAR(100) NULL DEFAULT (NULL),
	"tier2" VARCHAR(100) NULL DEFAULT (NULL),
	"tier3" VARCHAR(100) NULL DEFAULT (NULL),
	"tier4" VARCHAR(100) NULL DEFAULT (NULL),
	"limit_band" VARCHAR(100) NULL DEFAULT (NULL),
	"refno" VARCHAR(100) NULL DEFAULT (NULL),
	"Tenor1" VARCHAR(100) NULL DEFAULT (NULL),
	"Rate1" VARCHAR(100) NULL DEFAULT (NULL),
	"Tenor2" VARCHAR(100) NULL DEFAULT (NULL),
	"Rate2" VARCHAR(100) NULL DEFAULT (NULL),
	"Tenor3" VARCHAR(100) NULL DEFAULT (NULL),
	"Rate3" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_06_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_06_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_06_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_06_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_12_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_12_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_12_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_12_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_18_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_18_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_18_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_18_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Start_Tele" VARCHAR(100) NULL DEFAULT (NULL),
	"End_Tele" VARCHAR(100) NULL DEFAULT (NULL),
	"CIP_TYPE" VARCHAR(100) NULL DEFAULT (NULL),
	"CUSTNO1" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T18_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T18_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T18_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T18_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T24_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T24_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T24_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T24_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T3_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T3_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T3_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T3_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_03_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_03_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_03_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_03_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Tenor4" VARCHAR(100) NULL DEFAULT (NULL),
	"Rate4" VARCHAR(100) NULL DEFAULT (NULL),
	"Sex" VARCHAR(100) NULL DEFAULT (NULL),
	"OCCUPATION" VARCHAR(100) NULL DEFAULT (NULL),
	"flag_supplement" VARCHAR(100) NULL DEFAULT (NULL),
	"Billing_Address" VARCHAR(100) NULL DEFAULT (NULL),
	"flag_bestbill" VARCHAR(100) NULL DEFAULT (NULL),
	"flag_area" VARCHAR(100) NULL DEFAULT (NULL),
	"propensity_CIP" VARCHAR(100) NULL DEFAULT (NULL),
	"Tenor5" VARCHAR(100) NULL DEFAULT (NULL),
	"Rate5" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_24_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_24_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_24_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_24_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T4_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T4_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T4_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T4_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Recsource" VARCHAR(100) NULL DEFAULT (NULL),
	"count_of_supplement" VARCHAR(100) NULL DEFAULT (NULL),
	"count_of_primary_card" VARCHAR(100) NULL DEFAULT (NULL),
	"Classic_card" VARCHAR(100) NULL DEFAULT (NULL),
	"Gold_card" VARCHAR(100) NULL DEFAULT (NULL),
	"Cashback_card" VARCHAR(100) NULL DEFAULT (NULL),
	"Platinum_card" VARCHAR(100) NULL DEFAULT (NULL),
	"Signature_card" VARCHAR(100) NULL DEFAULT (NULL),
	"Premier_card" VARCHAR(100) NULL DEFAULT (NULL)
);

-- t_gn_attr_cip_dormant : perbaikan struktur table, id auto increment
CREATE TABLE "t_gn_attr_cip_dormant" (
	"id" INT IDENTITY(1,1) PRIMARY KEY,
	"CustomerId" INT NOT NULL,
	"Cardno" VARCHAR(100) NULL DEFAULT (NULL),
	"accno" VARCHAR(100) NULL DEFAULT (NULL),
	"Name" VARCHAR(100) NULL DEFAULT (NULL),
	"DOB" VARCHAR(100) NULL DEFAULT (NULL),
	"Limit" VARCHAR(100) NULL DEFAULT (NULL),
	"balance" VARCHAR(100) NULL DEFAULT (NULL),
	"phone1" VARCHAR(100) NULL DEFAULT (NULL),
	"phone2" VARCHAR(100) NULL DEFAULT (NULL),
	"MOBILE" VARCHAR(100) NULL DEFAULT (NULL),
	"prod" VARCHAR(100) NULL DEFAULT (NULL),
	"cycle" VARCHAR(100) NULL DEFAULT (NULL),
	"UTILISATION" VARCHAR(100) NULL DEFAULT (NULL),
	"DUE_DATE" VARCHAR(100) NULL DEFAULT (NULL),
	"GENERATION_DT" VARCHAR(100) NULL DEFAULT (NULL),
	"Dbase_Expire_dt" VARCHAR(100) NULL DEFAULT (NULL),
	"card_expr_txt" VARCHAR(100) NULL DEFAULT (NULL),
	"addr1" VARCHAR(100) NULL DEFAULT (NULL),
	"addr2" VARCHAR(100) NULL DEFAULT (NULL),
	"addr3" VARCHAR(100) NULL DEFAULT (NULL),
	"addr4" VARCHAR(100) NULL DEFAULT (NULL),
	"zip" VARCHAR(100) NULL DEFAULT (NULL),
	"tier1" VARCHAR(100) NULL DEFAULT (NULL),
	"tier2" VARCHAR(100) NULL DEFAULT (NULL),
	"tier3" VARCHAR(100) NULL DEFAULT (NULL),
	"tier4" VARCHAR(100) NULL DEFAULT (NULL),
	"limit_band" VARCHAR(100) NULL DEFAULT (NULL),
	"refno" VARCHAR(100) NULL DEFAULT (NULL),
	"Tenor1" VARCHAR(100) NULL DEFAULT (NULL),
	"Rate1" VARCHAR(100) NULL DEFAULT (NULL),
	"Tenor2" VARCHAR(100) NULL DEFAULT (NULL),
	"Rate2" VARCHAR(100) NULL DEFAULT (NULL),
	"Tenor3" VARCHAR(100) NULL DEFAULT (NULL),
	"Rate3" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_06_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_06_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_06_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_06_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_12_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_12_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_12_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_12_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_18_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_18_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_18_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_18_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Start_Tele" VARCHAR(100) NULL DEFAULT (NULL),
	"End_Tele" VARCHAR(100) NULL DEFAULT (NULL),
	"CIP_TYPE" VARCHAR(100) NULL DEFAULT (NULL),
	"CUSTNO1" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T18_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T18_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T18_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T18_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T24_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T24_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T24_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Free_Interest_T24_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T3_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T3_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T3_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T3_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_03_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_03_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_03_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_03_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Tenor4" VARCHAR(100) NULL DEFAULT (NULL),
	"Rate4" VARCHAR(100) NULL DEFAULT (NULL),
	"Sex" VARCHAR(100) NULL DEFAULT (NULL),
	"OCCUPATION" VARCHAR(100) NULL DEFAULT (NULL),
	"flag_supplement" VARCHAR(100) NULL DEFAULT (NULL),
	"Billing_Address" VARCHAR(100) NULL DEFAULT (NULL),
	"flag_bestbill" VARCHAR(100) NULL DEFAULT (NULL),
	"flag_area" VARCHAR(100) NULL DEFAULT (NULL),
	"propensity_CIP" VARCHAR(100) NULL DEFAULT (NULL),
	"Tenor5" VARCHAR(100) NULL DEFAULT (NULL),
	"Rate5" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_24_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_24_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_24_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Month_ins_24_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T4_1" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T4_2" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T4_3" VARCHAR(100) NULL DEFAULT (NULL),
	"Admin_Fee_T4_4" VARCHAR(100) NULL DEFAULT (NULL),
	"Recsource" VARCHAR(100) NULL DEFAULT (NULL),
	"count_of_supplement" VARCHAR(100) NULL DEFAULT (NULL),
	"count_of_primary_card" VARCHAR(100) NULL DEFAULT (NULL),
	"Classic_card" VARCHAR(100) NULL DEFAULT (NULL),
	"Gold_card" VARCHAR(100) NULL DEFAULT (NULL),
	"Cashback_card" VARCHAR(100) NULL DEFAULT (NULL),
	"Platinum_card" VARCHAR(100) NULL DEFAULT (NULL),
	"Signature_card" VARCHAR(100) NULL DEFAULT (NULL),
	"Premier_card" VARCHAR(100) NULL DEFAULT (NULL)
);

-- update t_gn_attr_flexi add field :
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "Recsource" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'Recsource';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "HubID" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'HubID';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "ZIP" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'ZIP';

-- add table upload invalid :
CREATE TABLE "t_gn_upload_invalid" (
	"id" INT IDENTITY(0,1) PRIMARY KEY,
	"FTP_UploadId" INT NULL DEFAULT (NULL),
	"Data_Upload" TEXT NULL DEFAULT NULL,
	"Create_Ts" DATETIME2 NULL DEFAULT NULL COMMENT ''
);

