-- FLEXI --

SET IDENTITY_INSERT t_gn_detail_template ON
INSERT INTO "t_gn_detail_template" ("Id","UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES

	(692,9, 'Recsource', '', 'Recsource', 51, NULL),
	(693,9, 'ZIP', '', 'ZIP', 52, NULL),
	(694,9, 'HubID', '', 'HubID', 53, NULL),
	(695,9, 'Flag_type', '', 'Flag_type',54, NULL),
	(696,9, 'HubID_V', '', 'HubID_V', 55, NULL),
	(697,9, 'Need_Update_Income', '', 'Need_Update_Income', 56, NULL),
	(698,9, 'Ever_CDD', '', 'Ever_CDD', 57, NULL),
	(699,9, 'H_addr1', '', 'H_addr1', 58, NULL),
	(700,9, 'H_addr2', '', 'H_addr2', 59, NULL),
	(701,9, 'H_addr3', '', 'H_addr3',60, NULL),
	(702,9, 'H_addr4', '', 'H_addr4',61, NULL),
	(703,9, 'H_zipcode', '', 'H_zipcode',62, NULL),
	(704,9, 'flag_util', '', 'flag_util',63, NULL),
	(705,9, 'ocp_code_hub', '', 'ocp_code_hub',64, NULL),
	(706,9, 'ocp_desc_hub', '', 'ocp_desc_hub',65, NULL),
	(707,9, 'count_of_supplement', '', 'count_of_supplement',66, NULL),
	(708,9, 'count_of_primary_card', '', 'count_of_primary_card',67, NULL),
	(709,9, 'Classic_card', '', 'Classic_card',68, NULL),
	(710,9, 'Gold_card', '', 'Gold_card',69, NULL),
	(711,9, 'Cashback_card', '', 'Cashback_card', 70, NULL),
	(712,9, 'Platinum_card', '', 'Platinum_card', 71, NULL),
	(713,9, 'Signature_card', '', 'Signature_card', 72, NULL),
	(714,9, 'Premier_card', '', 'Premier_card', 73, NULL),
	(715,9, 'prog_code', '', 'prog_code', 74, NULL),
	(716,9, 'Data_Month', '', 'Data_Month', 75, NULL);
SET IDENTITY_INSERT t_gn_detail_template OFF 

ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "Flag_type" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'Flag_type';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "HubID_V" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'HubID_V';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "Need_Update_Income" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'Need_Update_Income';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "Ever_CDD" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'Ever_CDD';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "H_addr1" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'H_addr1';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "H_addr2" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'H_addr2';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "H_addr3" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'H_addr3';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "H_addr4" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'H_addr4';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "H_zipcode" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'H_zipcode';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "flag_util" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'flag_util';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "ocp_code_hub" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'ocp_code_hub';
ALTER TABLE "dbo"."t_gn_attr_flexi"

	ADD "ocp_desc_hub" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'ocp_desc_hub';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "count_of_supplement" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'count_of_supplement';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "count_of_primary_card" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'count_of_primary_card';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "Classic_card" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'Classic_card';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "Gold_card" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'Gold_card';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "Cashback_card" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'Cashback_card';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "Platinum_card" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'Platinum_card';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "Signature_card" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'Signature_card';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "Premier_card" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'Premier_card';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "prog_code" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'prog_code';
ALTER TABLE "dbo"."t_gn_attr_flexi"
	ADD "Data_Month" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_flexi', 'column', 'Data_Month';

-- TUTUP FLEXI --


-- PIL XSELL --

SET IDENTITY_INSERT t_gn_detail_template ON
INSERT INTO "t_gn_detail_template" ("Id","UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES

	(717,5, 'Recsource', '', 'Recsource', 93, NULL),
	(718,5, 'Cycle', '', 'Cycle', 94, NULL),
	(719,5, 'Type', '', 'Type', 95, NULL),
	(720,5, 'HubID_H', '', 'HubID_H', 96, NULL),
	(721,5, 'Flag_type', '', 'Flag_type', 97, NULL),
	(722,5, 'HubID_W', '', 'HubID_W', 98, NULL),
	(723,5, 'Need_Update_Income', '', 'Need_Update_Income', 99, NULL),
	(724,5, 'Ever_CDD', '', 'Ever_CDD', 100, NULL),
	(725,5, 'flag_util', '', 'flag_util', 101, NULL),
	(726,5, 'ocp_code_hub', '', 'ocp_code_hub', 102, NULL),
	(727,5, 'ocp_desc_hub', '', 'ocp_desc_hub', 103, NULL),
	(728,5, 'count_of_supplement', '', 'count_of_supplement', 104, NULL),
	(729,5, 'count_of_primary_card', '', 'count_of_primary_card', 105, NULL),
	(730,5, 'Classic_card', '', 'Classic_card', 106, NULL),
	(731,5, 'Gold_card', '', 'Gold_card', 107, NULL),
	(732,5, 'Cashback_card', '', 'Cashback_card', 108, NULL),
	(733,5, 'Platinum_card', '', 'Platinum_card', 109, NULL),
	(734,5, 'Signature_card', '', 'Signature_card', 110, NULL),
	(735,5, 'Premier_card', '', 'Premier_card', 111, NULL),
	(736,5, 'prog_code', '', 'prog_code', 112, NULL),
	(737,5, 'Data_Month', '', 'Data_Month', 113, NULL),
SET IDENTITY_INSERT t_gn_detail_template OFF 

ALTER TABLE "dbo"."t_gn_attr_pil_xsell"
	ADD "Cycle" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_xsell', 'column', 'Cycle';
ALTER TABLE "dbo"."t_gn_attr_pil_xsell"
	ADD "Type" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_xsell', 'column', 'Type';
ALTER TABLE "dbo"."t_gn_attr_pil_xsell"
	ADD "HubID_H" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_xsell', 'column', 'HubID_H';
ALTER TABLE "dbo"."t_gn_attr_pil_xsell"
	ADD "Flag_type" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_xsell', 'column', 'Flag_type';
ALTER TABLE "dbo"."t_gn_attr_pil_xsell"
	ADD "HubID_W" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_xsell', 'column', 'HubID_W';
ALTER TABLE "dbo"."t_gn_attr_pil_xsell"
	ADD "Need_Update_Income" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_xsell', 'column', 'Need_Update_Income';
ALTER TABLE "dbo"."t_gn_attr_pil_xsell"
	ADD "Ever_CDD" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_xsell', 'column', 'Ever_CDD';
ALTER TABLE "dbo"."t_gn_attr_pil_xsell"
	ADD "flag_util" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_xsell', 'column', 'flag_util';
ALTER TABLE "dbo"."t_gn_attr_pil_xsell"
	ADD "ocp_code_hub" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_xsell', 'column', 'ocp_code_hub';
ALTER TABLE "dbo"."t_gn_attr_pil_xsell"
	ADD "ocp_desc_hub" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_xsell', 'column', 'ocp_desc_hub';
ALTER TABLE "dbo"."t_gn_attr_pil_xsell"
	ADD "count_of_supplement" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_xsell', 'column', 'count_of_supplement';
ALTER TABLE "dbo"."t_gn_attr_pil_xsell"
	ADD "count_of_primary_card" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_xsell', 'column', 'count_of_primary_card';
ALTER TABLE "dbo"."t_gn_attr_pil_xsell"
	ADD "Classic_card" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_xsell', 'column', 'Classic_card';
ALTER TABLE "dbo"."t_gn_attr_pil_xsell"
	ADD "Gold_card" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_xsell', 'column', 'Gold_card';
ALTER TABLE "dbo"."t_gn_attr_pil_xsell"
	ADD "Cashback_card" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_xsell', 'column', 'Cashback_card';
ALTER TABLE "dbo"."t_gn_attr_pil_xsell"
	ADD "Platinum_card" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_xsell', 'column', 'Platinum_card';
ALTER TABLE "dbo"."t_gn_attr_pil_xsell"
	ADD "Signature_card" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_xsell', 'column', 'Signature_card';
ALTER TABLE "dbo"."t_gn_attr_pil_xsell"
	ADD "Premier_card" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_xsell', 'column', 'Premier_card';
ALTER TABLE "dbo"."t_gn_attr_pil_xsell"
	ADD "prog_code" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_xsell', 'column', 'prog_code';
ALTER TABLE "dbo"."t_gn_attr_pil_xsell"
	ADD "Data_Month" VARCHAR(250) NULL DEFAULT (NULL);
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_pil_xsell', 'column', 'Data_Month';



----------------------------------------------------------------------------------------------

-- CIP DORMANT --

CREATE TABLE IF NOT EXISTS "t_gn_attr_cip_dormant" (
	"id" INT(10,0) NOT NULL,
	"CustomerId" INT(10,0) NOT NULL,
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
	PRIMARY KEY ("id")
);

INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder") VALUES
	(10, 'Cardno', '', 'Cardno', 1),
	(10, 'accno', '', 'accno', 2),
	(10, 'Name', '', 'Name', 3),
	(10, 'DOB', '', 'DOB', 4),
	(10, 'Limit', '', 'Limit', 5),
	(10, 'balance', '', 'balance', 6),
	(10, 'phone1', '', 'phone1', 7),
	(10, 'phone2', '', 'phone2', 8),
	(10, 'MOBILE', '', 'MOBILE', 9),
	(10, 'prod', '', 'prod',  10),
	(10, 'cycle', '', 'cycle', 11),
	(10, 'UTILISATION', '', 'UTILISATION', 12),
	(10, 'DUE_DATE', '', 'DUE_DATE', 13),
	(10, 'GENERATION_DT', '', 'GENERATION_DT', 14),
	(10, 'Dbase_Expire_dt', '', 'Dbase_Expire_dt', 15),
	(10, 'card_expr_txt', '', 'card_expr_txt', 16),
	(10, 'addr1', '', 'addr1', 17),
	(10, 'addr2', '', 'addr2', 18),
	(10, 'addr3', '', 'addr3', 19),
	(10, 'addr4', '', 'addr4', 20),
	(10, 'zip', '', 'zip', 21),
	(10, 'tier1', '', 'tier1', 22),
	(10, 'tier2', '', 'tier2', 23),
	(10, 'tier3', '', 'tier3', 24),
	(10, 'tier4', '', 'tier4', 25),
	(10, 'limit_band', '', 'limit_band', 26),
	(10, 'refno', '', 'refno', 27),
	(10, 'Tenor1', '', 'Tenor1', 28),
	(10, 'Rate1', '', 'Rate1', 29),
	(10, 'Tenor2', '', 'Tenor2', 30),
	(10, 'Rate2', '', 'Rate2', 31),
	(10, 'Tenor3', '', 'Tenor3', 32),
	(10, 'Rate3', '', 'Rate3', 33),
	(10, 'Month_ins_06_1', '', 'Month_ins_06_1', 34),
	(10, 'Month_ins_06_2', '', 'Month_ins_06_2', 35),
	(10, 'Month_ins_06_3', '', 'Month_ins_06_3', 36),
	(10, 'Month_ins_06_4', '', 'Month_ins_06_4', 37),
	(10, 'Month_ins_12_1', '', 'Month_ins_12_1', 38),
	(10, 'Month_ins_12_2', '', 'Month_ins_12_2', 39),
	(10, 'Month_ins_12_3', '', 'Month_ins_12_3', 40),
	(10, 'Month_ins_12_4', '', 'Month_ins_12_4', 41),
	(10, 'Month_ins_18_1', '', 'Month_ins_18_1', 42),
	(10, 'Month_ins_18_2', '', 'Month_ins_18_2', 43),
	(10, 'Month_ins_18_3', '', 'Month_ins_18_3', 44),
	(10, 'Month_ins_18_4', '', 'Month_ins_18_4', 45),
	(10, 'Start_Tele', '', 'Start_Tele', 46),
	(10, 'End_Tele', '', 'End_Tele', 47),
	(10, 'CIP_TYPE', '', 'CIP_TYPE', 48),
	(10, 'Custno1', '', 'Custno1', 49),
	(10, 'Free_Interest_T18_1', '', 'Free_Interest_T18_1', 50),
	(10, 'Free_Interest_T18_2', '', 'Free_Interest_T18_2', 51),
	(10, 'Free_Interest_T18_3', '', 'Free_Interest_T18_3', 52),
	(10, 'Free_Interest_T18_4', '', 'Free_Interest_T18_4', 53),
	(10, 'Free_Interest_T24_1', '', 'Free_Interest_T24_1', 54),
	(10, 'Free_Interest_T24_2', '', 'Free_Interest_T24_2', 55),
	(10, 'Free_Interest_T24_3', '', 'Free_Interest_T24_3', 56),
	(10, 'Free_Interest_T24_4', '', 'Free_Interest_T24_4', 57),
	(10, 'Admin_Fee_T3_1', '', 'Admin_Fee_T3_1', 58),
	(10, 'Admin_Fee_T3_2', '', 'Admin_Fee_T3_2', 59),
	(10, 'Admin_Fee_T3_3', '', 'Admin_Fee_T3_3', 60),
	(10, 'Admin_Fee_T3_4', '', 'Admin_Fee_T3_4', 61),
	(10, 'Month_ins_03_1', '', 'Month_ins_03_1', 62),
	(10, 'Month_ins_03_2', '', 'Month_ins_03_2', 63),
	(10, 'Month_ins_03_3', '', 'Month_ins_03_3', 64),
	(10, 'Month_ins_03_4', '', 'Month_ins_03_4', 65),
	(10, 'Tenor4', '', 'Tenor4', 66),
	(10, 'Rate4', '', 'Rate4', 67),
	(10, 'Sex', '', 'Sex', 68),
	(10, 'occupation', '', 'occupation', 69),
	(10, 'flag_supplement', '', 'flag_supplement', 70),
	(10, 'Billing_Address', '', 'Billing_Address', 71),
	(10, 'flag_bestbill', '', 'flag_bestbill', 72),
	(10, 'flag_area', '', 'flag_area', 73),
	(10, 'propensity_CIP', '', 'propensity_CIP', 74),
	(10, 'Tenor5', '', 'Tenor5', 75),
	(10, 'Rate5', '', 'Rate5', 76),
	(10, 'Month_ins_24_1', '', 'Month_ins_24_1', 77),
	(10, 'Month_ins_24_2', '', 'Month_ins_24_2', 78),
	(10, 'Month_ins_24_3', '', 'Month_ins_24_3', 79),
	(10, 'Month_ins_24_4', '', 'Month_ins_24_4', 80),
	(10, 'Admin_Fee_T4_1', '', 'Admin_Fee_T4_1', 81),
	(10, 'Admin_Fee_T4_2', '', 'Admin_Fee_T4_2', 82),
	(10, 'Admin_Fee_T4_3', '', 'Admin_Fee_T4_3', 83),
	(10, 'Admin_Fee_T4_4', '', 'Admin_Fee_T4_4', 84),
	(10, 'Recsources', '', 'Recsources', 85),
	(10, 'count_of_supplement', '', 'count_of_supplement', 86),
	(10, 'count_of_primary_card', '', 'count_of_primary_card', 87),
	(10, 'Classic_card', '', 'Classic_card', 88),
	(10, 'Gold_card', '', 'Gold_card', 89),
	(10, 'Cashback_card', '', 'Cashback_card', 90),
	(10, 'Platinum_card', '', 'Platinum_card', 91),
	(10, 'Signature_card', '', 'Signature_card', 92),
	(10, 'Premier_card', '', 'Premier_card', 93),


-- TUTUP CIP DORMANT --

-- CIP SPC --

CREATE TABLE IF NOT EXISTS "t_gn_attr_cip_spc" (
	"id" INT(10,0) NOT NULL,
	"CustomerId" INT(10,0) NOT NULL,
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
	PRIMARY KEY ("id")
);

INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder") VALUES
	(11, 'Cardno', '', 'Cardno', 1),
	(11, 'accno', '', 'accno', 2),
	(11, 'Name', '', 'Name', 3),
	(11, 'DOB', '', 'DOB', 4),
	(11, 'Limit', '', 'Limit', 5),
	(11, 'balance', '', 'balance', 6),
	(11, 'phone1', '', 'phone1', 7),
	(11, 'phone2', '', 'phone2', 8),
	(11, 'MOBILE', '', 'MOBILE', 9),
	(11, 'prod', '', 'prod',  10),
	(11, 'cycle', '', 'cycle', 11),
	(11, 'UTILISATION', '', 'UTILISATION', 12),
	(11, 'DUE_DATE', '', 'DUE_DATE', 13),
	(11, 'GENERATION_DT', '', 'GENERATION_DT', 14),
	(11, 'Dbase_Expire_dt', '', 'Dbase_Expire_dt', 15),
	(11, 'card_expr_txt', '', 'card_expr_txt', 16),
	(11, 'addr1', '', 'addr1', 17),
	(11, 'addr2', '', 'addr2', 18),
	(11, 'addr3', '', 'addr3', 19),
	(11, 'addr4', '', 'addr4', 20),
	(11, 'zip', '', 'zip', 21),
	(11, 'tier1', '', 'tier1', 22),
	(11, 'tier2', '', 'tier2', 23),
	(11, 'tier3', '', 'tier3', 24),
	(11, 'tier4', '', 'tier4', 25),
	(11, 'limit_band', '', 'limit_band', 26),
	(11, 'refno', '', 'refno', 27),
	(11, 'Tenor1', '', 'Tenor1', 28),
	(11, 'Rate1', '', 'Rate1', 29),
	(11, 'Tenor2', '', 'Tenor2', 30),
	(11, 'Rate2', '', 'Rate2', 31),
	(11, 'Tenor3', '', 'Tenor3', 32),
	(11, 'Rate3', '', 'Rate3', 33),
	(11, 'Month_ins_06_1', '', 'Month_ins_06_1', 34),
	(11, 'Month_ins_06_2', '', 'Month_ins_06_2', 35),
	(11, 'Month_ins_06_3', '', 'Month_ins_06_3', 36),
	(11, 'Month_ins_06_4', '', 'Month_ins_06_4', 37),
	(11, 'Month_ins_12_1', '', 'Month_ins_12_1', 38),
	(11, 'Month_ins_12_2', '', 'Month_ins_12_2', 39),
	(11, 'Month_ins_12_3', '', 'Month_ins_12_3', 40),
	(11, 'Month_ins_12_4', '', 'Month_ins_12_4', 41),
	(11, 'Month_ins_18_1', '', 'Month_ins_18_1', 42),
	(11, 'Month_ins_18_2', '', 'Month_ins_18_2', 43),
	(11, 'Month_ins_18_3', '', 'Month_ins_18_3', 44),
	(11, 'Month_ins_18_4', '', 'Month_ins_18_4', 45),
	(11, 'Start_Tele', '', 'Start_Tele', 46),
	(11, 'End_Tele', '', 'End_Tele', 47),
	(11, 'CIP_TYPE', '', 'CIP_TYPE', 48),
	(11, 'Custno1', '', 'Custno1', 49),
	(11, 'Free_Interest_T18_1', '', 'Free_Interest_T18_1', 50),
	(11, 'Free_Interest_T18_2', '', 'Free_Interest_T18_2', 51),
	(11, 'Free_Interest_T18_3', '', 'Free_Interest_T18_3', 52),
	(11, 'Free_Interest_T18_4', '', 'Free_Interest_T18_4', 53),
	(11, 'Free_Interest_T24_1', '', 'Free_Interest_T24_1', 54),
	(11, 'Free_Interest_T24_2', '', 'Free_Interest_T24_2', 55),
	(11, 'Free_Interest_T24_3', '', 'Free_Interest_T24_3', 56),
	(11, 'Free_Interest_T24_4', '', 'Free_Interest_T24_4', 57),
	(11, 'Admin_Fee_T3_1', '', 'Admin_Fee_T3_1', 58),
	(11, 'Admin_Fee_T3_2', '', 'Admin_Fee_T3_2', 59),
	(11, 'Admin_Fee_T3_3', '', 'Admin_Fee_T3_3', 60),
	(11, 'Admin_Fee_T3_4', '', 'Admin_Fee_T3_4', 61),
	(11, 'Month_ins_03_1', '', 'Month_ins_03_1', 62),
	(11, 'Month_ins_03_2', '', 'Month_ins_03_2', 63),
	(11, 'Month_ins_03_3', '', 'Month_ins_03_3', 64),
	(11, 'Month_ins_03_4', '', 'Month_ins_03_4', 65),
	(11, 'Tenor4', '', 'Tenor4', 66),
	(11, 'Rate4', '', 'Rate4', 67),
	(11, 'Sex', '', 'Sex', 68),
	(11, 'occupation', '', 'occupation', 69),
	(11, 'flag_supplement', '', 'flag_supplement', 70),
	(11, 'Billing_Address', '', 'Billing_Address', 71),
	(11, 'flag_bestbill', '', 'flag_bestbill', 72),
	(11, 'flag_area', '', 'flag_area', 73),
	(11, 'propensity_CIP', '', 'propensity_CIP', 74),
	(11, 'Tenor5', '', 'Tenor5', 75),
	(11, 'Rate5', '', 'Rate5', 76),
	(11, 'Month_ins_24_1', '', 'Month_ins_24_1', 77),
	(11, 'Month_ins_24_2', '', 'Month_ins_24_2', 78),
	(11, 'Month_ins_24_3', '', 'Month_ins_24_3', 79),
	(11, 'Month_ins_24_4', '', 'Month_ins_24_4', 80),
	(11, 'Admin_Fee_T4_1', '', 'Admin_Fee_T4_1', 81),
	(11, 'Admin_Fee_T4_2', '', 'Admin_Fee_T4_2', 82),
	(11, 'Admin_Fee_T4_3', '', 'Admin_Fee_T4_3', 83),
	(11, 'Admin_Fee_T4_4', '', 'Admin_Fee_T4_4', 84),
	(11, 'Recsources', '', 'Recsources', 85),
	(11, 'count_of_supplement', '', 'count_of_supplement', 86),
	(11, 'count_of_primary_card', '', 'count_of_primary_card', 87),
	(11, 'Classic_card', '', 'Classic_card', 88),
	(11, 'Gold_card', '', 'Gold_card', 89),
	(11, 'Cashback_card', '', 'Cashback_card', 90),
	(11, 'Platinum_card', '', 'Platinum_card', 91),
	(11, 'Signature_card', '', 'Signature_card', 92),
	(11, 'Premier_card', '', 'Premier_card', 93),


-- TUTUP CIP SPC --


-- CIP NTB --

CREATE TABLE IF NOT EXISTS "t_gn_attr_ntb_new" (
	"id" INT(10,0) NOT NULL,
	"CustomerId" INT(10,0) NOT NULL,
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
	PRIMARY KEY ("id")
);

INSERT INTO "t_gn_template" ("TemplateId", "TemplateTableName", "TemplateName", "TemplateMode", "TemplateFileType", "TemplateSparator", "TemplateBlacklist", "TemplateLimitDays", "TemplateBucket", "TemplateFlags", "TemplateModul", "TemplateCreateTs") VALUES
(12, 't_gn_attr_cip_ntb_new', 'CIP NTB NEW', 'insert', 'excel     ', NULL, 'N', NULL, 'Y', 1, 'U_Cip_Ntb_new', '2019-10-09 10:20:57.0000000');

INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder") VALUES
	(12, 'Cardno', '', 'Cardno', 1),
	(12, 'accno', '', 'accno', 2),
	(12, 'Name', '', 'Name', 3),
	(12, 'DOB', '', 'DOB', 4),
	(12, 'Limit', '', 'Limit', 5),
	(12, 'balance', '', 'balance', 6),
	(12, 'phone1', '', 'phone1', 7),
	(12, 'phone2', '', 'phone2', 8),
	(12, 'MOBILE', '', 'MOBILE', 9),
	(12, 'prod', '', 'prod',  10),
	(12, 'cycle', '', 'cycle', 11),
	(12, 'UTILISATION', '', 'UTILISATION', 12),
	(12, 'DUE_DATE', '', 'DUE_DATE', 13),
	(12, 'GENERATION_DT', '', 'GENERATION_DT', 14),
	(12, 'Dbase_Expire_dt', '', 'Dbase_Expire_dt', 15),
	(12, 'card_expr_txt', '', 'card_expr_txt', 16),
	(12, 'addr1', '', 'addr1', 17),
	(12, 'addr2', '', 'addr2', 18),
	(12, 'addr3', '', 'addr3', 19),
	(12, 'addr4', '', 'addr4', 20),
	(12, 'zip', '', 'zip', 21),
	(12, 'tier1', '', 'tier1', 22),
	(12, 'tier2', '', 'tier2', 23),
	(12, 'tier3', '', 'tier3', 24),
	(12, 'tier4', '', 'tier4', 25),
	(12, 'limit_band', '', 'limit_band', 26),
	(12, 'refno', '', 'refno', 27),
	(12, 'Tenor1', '', 'Tenor1', 28),
	(12, 'Rate1', '', 'Rate1', 29),
	(12, 'Tenor2', '', 'Tenor2', 30),
	(12, 'Rate2', '', 'Rate2', 31),
	(12, 'Tenor3', '', 'Tenor3', 32),
	(12, 'Rate3', '', 'Rate3', 33),
	(12, 'Month_ins_06_1', '', 'Month_ins_06_1', 34),
	(12, 'Month_ins_06_2', '', 'Month_ins_06_2', 35),
	(12, 'Month_ins_06_3', '', 'Month_ins_06_3', 36),
	(12, 'Month_ins_06_4', '', 'Month_ins_06_4', 37),
	(12, 'Month_ins_12_1', '', 'Month_ins_12_1', 38),
	(12, 'Month_ins_12_2', '', 'Month_ins_12_2', 39),
	(12, 'Month_ins_12_3', '', 'Month_ins_12_3', 40),
	(12, 'Month_ins_12_4', '', 'Month_ins_12_4', 41),
	(12, 'Month_ins_18_1', '', 'Month_ins_18_1', 42),
	(12, 'Month_ins_18_2', '', 'Month_ins_18_2', 43),
	(12, 'Month_ins_18_3', '', 'Month_ins_18_3', 44),
	(12, 'Month_ins_18_4', '', 'Month_ins_18_4', 45),
	(12, 'Start_Tele', '', 'Start_Tele', 46),
	(12, 'End_Tele', '', 'End_Tele', 47),
	(12, 'CIP_TYPE', '', 'CIP_TYPE', 48),
	(12, 'Custno1', '', 'Custno1', 49),
	(12, 'Free_Interest_T18_1', '', 'Free_Interest_T18_1', 50),
	(12, 'Free_Interest_T18_2', '', 'Free_Interest_T18_2', 51),
	(12, 'Free_Interest_T18_3', '', 'Free_Interest_T18_3', 52),
	(12, 'Free_Interest_T18_4', '', 'Free_Interest_T18_4', 53),
	(12, 'Free_Interest_T24_1', '', 'Free_Interest_T24_1', 54),
	(12, 'Free_Interest_T24_2', '', 'Free_Interest_T24_2', 55),
	(12, 'Free_Interest_T24_3', '', 'Free_Interest_T24_3', 56),
	(12, 'Free_Interest_T24_4', '', 'Free_Interest_T24_4', 57),
	(12, 'Admin_Fee_T3_1', '', 'Admin_Fee_T3_1', 58),
	(12, 'Admin_Fee_T3_2', '', 'Admin_Fee_T3_2', 59),
	(12, 'Admin_Fee_T3_3', '', 'Admin_Fee_T3_3', 60),
	(12, 'Admin_Fee_T3_4', '', 'Admin_Fee_T3_4', 61),
	(12, 'Month_ins_03_1', '', 'Month_ins_03_1', 62),
	(12, 'Month_ins_03_2', '', 'Month_ins_03_2', 63),
	(12, 'Month_ins_03_3', '', 'Month_ins_03_3', 64),
	(12, 'Month_ins_03_4', '', 'Month_ins_03_4', 65),
	(12, 'Tenor4', '', 'Tenor4', 66),
	(12, 'Rate4', '', 'Rate4', 67),
	(12, 'Sex', '', 'Sex', 68),
	(12, 'occupation', '', 'occupation', 69),
	(12, 'flag_supplement', '', 'flag_supplement', 70),
	(12, 'Billing_Address', '', 'Billing_Address', 71),
	(12, 'flag_bestbill', '', 'flag_bestbill', 72),
	(12, 'flag_area', '', 'flag_area', 73),
	(12, 'propensity_CIP', '', 'propensity_CIP', 74),
	(12, 'Tenor5', '', 'Tenor5', 75),
	(12, 'Rate5', '', 'Rate5', 76),
	(12, 'Month_ins_24_1', '', 'Month_ins_24_1', 77),
	(12, 'Month_ins_24_2', '', 'Month_ins_24_2', 78),
	(12, 'Month_ins_24_3', '', 'Month_ins_24_3', 79),
	(12, 'Month_ins_24_4', '', 'Month_ins_24_4', 80),
	(12, 'Admin_Fee_T4_1', '', 'Admin_Fee_T4_1', 81),
	(12, 'Admin_Fee_T4_2', '', 'Admin_Fee_T4_2', 82),
	(12, 'Admin_Fee_T4_3', '', 'Admin_Fee_T4_3', 83),
	(12, 'Admin_Fee_T4_4', '', 'Admin_Fee_T4_4', 84),
	(12, 'Recsources', '', 'Recsources', 85),
	(12, 'count_of_supplement', '', 'count_of_supplement', 86),
	(12, 'count_of_primary_card', '', 'count_of_primary_card', 87),
	(12, 'Classic_card', '', 'Classic_card', 88),
	(12, 'Gold_card', '', 'Gold_card', 89),
	(12, 'Cashback_card', '', 'Cashback_card', 90),
	(12, 'Platinum_card', '', 'Platinum_card', 91),
	(12, 'Signature_card', '', 'Signature_card', 92),
	(12, 'Premier_card', '', 'Premier_card', 93);


-- TUTUP CIP NTB --

-- CIP REG NEW--


CREATE TABLE IF NOT EXISTS "t_gn_attr_reg_new" (
	"id" INT(10,0) NOT NULL,
	"CustomerId" INT(10,0) NOT NULL,
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
	PRIMARY KEY ("id")
);

INSERT INTO "t_gn_template" ("TemplateId", "TemplateTableName", "TemplateName", "TemplateMode", "TemplateFileType", "TemplateSparator", "TemplateBlacklist", "TemplateLimitDays", "TemplateBucket", "TemplateFlags", "TemplateModul", "TemplateCreateTs") VALUES
(12, 't_gn_attr_cip_reg_new', 'CIP REG NEW', 'insert', 'excel     ', NULL, 'N', NULL, 'Y', 1, 'U_Cip_Reg_new', '2019-10-09 10:20:57.0000000');

INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder") VALUES
	(13, 'Cardno', '', 'Cardno', 1),
	(13, 'accno', '', 'accno', 2),
	(13, 'Name', '', 'Name', 3),
	(13, 'DOB', '', 'DOB', 4),
	(13, 'Limit', '', 'Limit', 5),
	(13, 'balance', '', 'balance', 6),
	(13, 'phone1', '', 'phone1', 7),
	(13, 'phone2', '', 'phone2', 8),
	(13, 'MOBILE', '', 'MOBILE', 9),
	(13, 'prod', '', 'prod',  10),
	(13, 'cycle', '', 'cycle', 11),
	(13, 'UTILISATION', '', 'UTILISATION', 12),
	(13, 'DUE_DATE', '', 'DUE_DATE', 13),
	(13, 'GENERATION_DT', '', 'GENERATION_DT', 14),
	(13, 'Dbase_Expire_dt', '', 'Dbase_Expire_dt', 15),
	(13, 'card_expr_txt', '', 'card_expr_txt', 16),
	(13, 'addr1', '', 'addr1', 17),
	(13, 'addr2', '', 'addr2', 18),
	(13, 'addr3', '', 'addr3', 19),
	(13, 'addr4', '', 'addr4', 20),
	(13, 'zip', '', 'zip', 21),
	(13, 'tier1', '', 'tier1', 22),
	(13, 'tier2', '', 'tier2', 23),
	(13, 'tier3', '', 'tier3', 24),
	(13, 'tier4', '', 'tier4', 25),
	(13, 'limit_band', '', 'limit_band', 26),
	(13, 'refno', '', 'refno', 27),
	(13, 'Tenor1', '', 'Tenor1', 28),
	(13, 'Rate1', '', 'Rate1', 29),
	(13, 'Tenor2', '', 'Tenor2', 30),
	(13, 'Rate2', '', 'Rate2', 31),
	(13, 'Tenor3', '', 'Tenor3', 32),
	(13, 'Rate3', '', 'Rate3', 33),
	(13, 'Month_ins_06_1', '', 'Month_ins_06_1', 34),
	(13, 'Month_ins_06_2', '', 'Month_ins_06_2', 35),
	(13, 'Month_ins_06_3', '', 'Month_ins_06_3', 36),
	(13, 'Month_ins_06_4', '', 'Month_ins_06_4', 37),
	(13, 'Month_ins_12_1', '', 'Month_ins_12_1', 38),
	(13, 'Month_ins_12_2', '', 'Month_ins_12_2', 39),
	(13, 'Month_ins_12_3', '', 'Month_ins_12_3', 40),
	(13, 'Month_ins_12_4', '', 'Month_ins_12_4', 41),
	(13, 'Month_ins_18_1', '', 'Month_ins_18_1', 42),
	(13, 'Month_ins_18_2', '', 'Month_ins_18_2', 43),
	(13, 'Month_ins_18_3', '', 'Month_ins_18_3', 44),
	(13, 'Month_ins_18_4', '', 'Month_ins_18_4', 45),
	(13, 'Start_Tele', '', 'Start_Tele', 46),
	(13, 'End_Tele', '', 'End_Tele', 47),
	(13, 'CIP_TYPE', '', 'CIP_TYPE', 48),
	(13, 'Custno1', '', 'Custno1', 49),
	(13, 'Free_Interest_T18_1', '', 'Free_Interest_T18_1', 50),
	(13, 'Free_Interest_T18_2', '', 'Free_Interest_T18_2', 51),
	(13, 'Free_Interest_T18_3', '', 'Free_Interest_T18_3', 52),
	(13, 'Free_Interest_T18_4', '', 'Free_Interest_T18_4', 53),
	(13, 'Free_Interest_T24_1', '', 'Free_Interest_T24_1', 54),
	(13, 'Free_Interest_T24_2', '', 'Free_Interest_T24_2', 55),
	(13, 'Free_Interest_T24_3', '', 'Free_Interest_T24_3', 56),
	(13, 'Free_Interest_T24_4', '', 'Free_Interest_T24_4', 57),
	(13, 'Admin_Fee_T3_1', '', 'Admin_Fee_T3_1', 58),
	(13, 'Admin_Fee_T3_2', '', 'Admin_Fee_T3_2', 59),
	(13, 'Admin_Fee_T3_3', '', 'Admin_Fee_T3_3', 60),
	(13, 'Admin_Fee_T3_4', '', 'Admin_Fee_T3_4', 61),
	(13, 'Month_ins_03_1', '', 'Month_ins_03_1', 62),
	(13, 'Month_ins_03_2', '', 'Month_ins_03_2', 63),
	(13, 'Month_ins_03_3', '', 'Month_ins_03_3', 64),
	(13, 'Month_ins_03_4', '', 'Month_ins_03_4', 65),
	(13, 'Tenor4', '', 'Tenor4', 66),
	(13, 'Rate4', '', 'Rate4', 67),
	(13, 'Sex', '', 'Sex', 68),
	(13, 'occupation', '', 'occupation', 69),
	(13, 'flag_supplement', '', 'flag_supplement', 70),
	(13, 'Billing_Address', '', 'Billing_Address', 71),
	(13, 'flag_bestbill', '', 'flag_bestbill', 72),
	(13, 'flag_area', '', 'flag_area', 73),
	(13, 'propensity_CIP', '', 'propensity_CIP', 74),
	(13, 'Tenor5', '', 'Tenor5', 75),
	(13, 'Rate5', '', 'Rate5', 76),
	(13, 'Month_ins_24_1', '', 'Month_ins_24_1', 77),
	(13, 'Month_ins_24_2', '', 'Month_ins_24_2', 78),
	(13, 'Month_ins_24_3', '', 'Month_ins_24_3', 79),
	(13, 'Month_ins_24_4', '', 'Month_ins_24_4', 80),
	(13, 'Admin_Fee_T4_1', '', 'Admin_Fee_T4_1', 81),
	(13, 'Admin_Fee_T4_2', '', 'Admin_Fee_T4_2', 82),
	(13, 'Admin_Fee_T4_3', '', 'Admin_Fee_T4_3', 83),
	(13, 'Admin_Fee_T4_4', '', 'Admin_Fee_T4_4', 84),
	(13, 'Recsources', '', 'Recsources', 85),
	(13, 'count_of_supplement', '', 'count_of_supplement', 86),
	(13, 'count_of_primary_card', '', 'count_of_primary_card', 87),
	(13, 'Classic_card', '', 'Classic_card', 88),
	(13, 'Gold_card', '', 'Gold_card', 89),
	(13, 'Cashback_card', '', 'Cashback_card', 90),
	(13, 'Platinum_card', '', 'Platinum_card', 91),
	(13, 'Signature_card', '', 'Signature_card', 92),
	(13, 'Premier_card', '', 'Premier_card', 93);


	

	












-- Tutup CIP MLT NEW--

-- CIP MLT NEW--
CREATE TABLE IF NOT EXISTS "t_gn_attr_cip_mlt" (
	"id" INT(10,0) NOT NULL,
	"CustomerId" INT(10,0) NOT NULL,
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
	PRIMARY KEY ("id")
);

INSERT INTO "t_gn_template" ("TemplateId", "TemplateTableName", "TemplateName", "TemplateMode", "TemplateFileType", "TemplateSparator", "TemplateBlacklist", "TemplateLimitDays", "TemplateBucket", "TemplateFlags", "TemplateModul", "TemplateCreateTs") VALUES
(12, 't_gn_attr_cip_mlt', 'CIP MLT', 'insert', 'excel     ', NULL, 'N', NULL, 'Y', 1, 'U_Cip_MLT', '2019-10-09 10:20:57.0000000');

INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder") VALUES
	(14, 'Cardno', '', 'Cardno', 1),
	(14, 'accno', '', 'accno', 2),
	(14, 'Name', '', 'Name', 3),
	(14, 'DOB', '', 'DOB', 4),
	(14, 'Limit', '', 'Limit', 5),
	(14, 'balance', '', 'balance', 6),
	(14, 'phone1', '', 'phone1', 7),
	(14, 'phone2', '', 'phone2', 8),
	(14, 'MOBILE', '', 'MOBILE', 9),
	(14, 'prod', '', 'prod',  10),
	(14, 'cycle', '', 'cycle', 11),
	(14, 'UTILISATION', '', 'UTILISATION', 12),
	(14, 'DUE_DATE', '', 'DUE_DATE', 13),
	(14, 'GENERATION_DT', '', 'GENERATION_DT', 14),
	(14, 'Dbase_Expire_dt', '', 'Dbase_Expire_dt', 15),
	(14, 'card_expr_txt', '', 'card_expr_txt', 16),
	(14, 'addr1', '', 'addr1', 17),
	(14, 'addr2', '', 'addr2', 18),
	(14, 'addr3', '', 'addr3', 19),
	(14, 'addr4', '', 'addr4', 20),
	(14, 'zip', '', 'zip', 21),
	(14, 'tier1', '', 'tier1', 22),
	(14, 'tier2', '', 'tier2', 23),
	(14, 'tier3', '', 'tier3', 24),
	(14, 'tier4', '', 'tier4', 25),
	(14, 'limit_band', '', 'limit_band', 26),
	(14, 'refno', '', 'refno', 27),
	(14, 'Tenor1', '', 'Tenor1', 28),
	(14, 'Rate1', '', 'Rate1', 29),
	(14, 'Tenor2', '', 'Tenor2', 30),
	(14, 'Rate2', '', 'Rate2', 31),
	(14, 'Tenor3', '', 'Tenor3', 32),
	(14, 'Rate3', '', 'Rate3', 33),
	(14, 'Month_ins_06_1', '', 'Month_ins_06_1', 34),
	(14, 'Month_ins_06_2', '', 'Month_ins_06_2', 35),
	(14, 'Month_ins_06_3', '', 'Month_ins_06_3', 36),
	(14, 'Month_ins_06_4', '', 'Month_ins_06_4', 37),
	(14, 'Month_ins_12_1', '', 'Month_ins_12_1', 38),
	(14, 'Month_ins_12_2', '', 'Month_ins_12_2', 39),
	(14, 'Month_ins_12_3', '', 'Month_ins_12_3', 40),
	(14, 'Month_ins_12_4', '', 'Month_ins_12_4', 41),
	(14, 'Month_ins_18_1', '', 'Month_ins_18_1', 42),
	(14, 'Month_ins_18_2', '', 'Month_ins_18_2', 43),
	(14, 'Month_ins_18_3', '', 'Month_ins_18_3', 44),
	(14, 'Month_ins_18_4', '', 'Month_ins_18_4', 45),
	(14, 'Start_Tele', '', 'Start_Tele', 46),
	(14, 'End_Tele', '', 'End_Tele', 47),
	(14, 'CIP_TYPE', '', 'CIP_TYPE', 48),
	(14, 'Custno1', '', 'Custno1', 49),
	(14, 'Free_Interest_T18_1', '', 'Free_Interest_T18_1', 50),
	(14, 'Free_Interest_T18_2', '', 'Free_Interest_T18_2', 51),
	(14, 'Free_Interest_T18_3', '', 'Free_Interest_T18_3', 52),
	(14, 'Free_Interest_T18_4', '', 'Free_Interest_T18_4', 53),
	(14, 'Free_Interest_T24_1', '', 'Free_Interest_T24_1', 54),
	(14, 'Free_Interest_T24_2', '', 'Free_Interest_T24_2', 55),
	(14, 'Free_Interest_T24_3', '', 'Free_Interest_T24_3', 56),
	(14, 'Free_Interest_T24_4', '', 'Free_Interest_T24_4', 57),
	(14, 'Admin_Fee_T3_1', '', 'Admin_Fee_T3_1', 58),
	(14, 'Admin_Fee_T3_2', '', 'Admin_Fee_T3_2', 59),
	(14, 'Admin_Fee_T3_3', '', 'Admin_Fee_T3_3', 60),
	(14, 'Admin_Fee_T3_4', '', 'Admin_Fee_T3_4', 61),
	(14, 'Month_ins_03_1', '', 'Month_ins_03_1', 62),
	(14, 'Month_ins_03_2', '', 'Month_ins_03_2', 63),
	(14, 'Month_ins_03_3', '', 'Month_ins_03_3', 64),
	(14, 'Month_ins_03_4', '', 'Month_ins_03_4', 65),
	(14, 'Tenor4', '', 'Tenor4', 66),
	(14, 'Rate4', '', 'Rate4', 67),
	(14, 'Sex', '', 'Sex', 68),
	(14, 'occupation', '', 'occupation', 69),
	(14, 'flag_supplement', '', 'flag_supplement', 70),
	(14, 'Billing_Address', '', 'Billing_Address', 71),
	(14, 'flag_bestbill', '', 'flag_bestbill', 72),
	(14, 'flag_area', '', 'flag_area', 73),
	(14, 'propensity_CIP', '', 'propensity_CIP', 74),
	(14, 'Tenor5', '', 'Tenor5', 75),
	(14, 'Rate5', '', 'Rate5', 76),
	(14, 'Month_ins_24_1', '', 'Month_ins_24_1', 77),
	(14, 'Month_ins_24_2', '', 'Month_ins_24_2', 78),
	(14, 'Month_ins_24_3', '', 'Month_ins_24_3', 79),
	(14, 'Month_ins_24_4', '', 'Month_ins_24_4', 80),
	(14, 'Admin_Fee_T4_1', '', 'Admin_Fee_T4_1', 81),
	(14, 'Admin_Fee_T4_2', '', 'Admin_Fee_T4_2', 82),
	(14, 'Admin_Fee_T4_3', '', 'Admin_Fee_T4_3', 83),
	(14, 'Admin_Fee_T4_4', '', 'Admin_Fee_T4_4', 84),
	(14, 'Recsources', '', 'Recsources', 85),
	(14, 'count_of_supplement', '', 'count_of_supplement', 86),
	(14, 'count_of_primary_card', '', 'count_of_primary_card', 87),
	(14, 'Classic_card', '', 'Classic_card', 88),
	(14, 'Gold_card', '', 'Gold_card', 89),
	(14, 'Cashback_card', '', 'Cashback_card', 90),
	(14, 'Platinum_card', '', 'Platinum_card', 91),
	(14, 'Signature_card', '', 'Signature_card', 92),
	(14, 'Premier_card', '', 'Premier_card', 93);




-- adding field cutomer for verification

ALTER TABLE "dbo"."t_gn_customer"
	ADD "count_of_supplement" TINYINT NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_customer', 'column', 'count_of_supplement';
ALTER TABLE "dbo"."t_gn_customer"
	ADD "count_of_primary_card" TINYINT NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_customer', 'column', 'count_of_primary_card';
ALTER TABLE "dbo"."t_gn_customer"
	ADD "classic_card" TINYINT NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_customer', 'column', 'classic_card';
ALTER TABLE "dbo"."t_gn_customer"
	ADD "gold_card" TINYINT NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_customer', 'column', 'gold_card';
ALTER TABLE "dbo"."t_gn_customer"
	ADD "cashback_card" TINYINT NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_customer', 'column', 'cashback_card';
ALTER TABLE "dbo"."t_gn_customer"
	ADD "platinum_card" TINYINT NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_customer', 'column', 'platinum_card';
ALTER TABLE "dbo"."t_gn_customer"
	ADD "signature_card" TINYINT NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_customer', 'column', 'signature_card';
ALTER TABLE "dbo"."t_gn_customer"
	ADD "premier_card" TINYINT NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_customer', 'column', 'premier_card';




ALTER TABLE "dbo"."t_gn_campaign_ref"
	ADD "ViewCdd" VARCHAR(200) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_campaign_ref', 'column', 'ViewCdd';



UPDATE "hsbcp"."dbo"."t_gn_campaign_ref" SET "ViewCdd"='CddPilx' WHERE  "id"=5;
UPDATE "hsbcp"."dbo"."t_gn_campaign_ref" SET "ViewCdd"='CddPilx' WHERE  "id"=6;
UPDATE "hsbcp"."dbo"."t_gn_campaign_ref" SET "ViewCdd"='CddPilx' WHERE  "id"=9;


--insert disagrre table baru
SET IDENTITY_INSERT dbo.t_lk_disagree ON
INSERT INTO "t_lk_disagree" ("DisagreeId", "CampaignId", "CallreasonId", "DisagreeCode", "DisagreeDesc", "DisagreeFlag", "DisagreeOrder") VALUES
	--CIP Reg--
	(1, 1, 8, 'DL0', 'Bunga tinggi', 1, NULL),
	(2, 1, 8, 'DL1', 'Terlalu sering dihubungi untuk penawaran produk', 1, NULL),
	(3, 1, 8, 'DL2', 'Sudah punya produk yang sama di Bank lain', 1, NULL),
	(4, 1, 8, 'DL3', 'CH info kartu belum di aktifkan', 1, NULL),
	(5, 1, 8, 'DL5', 'CH keberatan untuk diverifikasi', 1, NULL),
	(6, 1, 8, 'DL6', ' CH info mau tutup/Sudah tutup/belum terima kartu', 1, NULL),
	(7, 1, 8, 'DL7', 'CH info kartunya hilang', 1, NULL),
	(8, 1, 8, 'DL8', 'Tidak mau punya utang atau pinjaman', 1, NULL),
	(9, 1, 8, 'DL9', 'CH langsung tutup telepon setelah greeting', 1, NULL),
	(10, 1, 8, 'DL10', 'Sudah punya produk Pinjaman', 1, NULL),
	(11, 1, 8, 'DL11', 'REJECT UFPRONT', 1, NULL),
	(12, 1, 8, 'DL12', 'DANA TERLALU KECIL', 1, NULL),
	(13, 1, 8, 'DL13', 'Tidak ingin ditelpon/Ditawari program apapun ', 1, NULL),
	(14, 1, 8, 'DL14', 'CH info bunga di bank lain lebih rendah', 1, NULL),
	(15, 1, 8, 'DL15', 'Disagree 2X', 1, NULL),
	(16, 1, 8, 'DL16', 'CH info proses CIP nya lama', 1, NULL),
	(17, 1, 8, 'DL17', 'BELUM ADA KEBUTUHAN', 1, NULL),
	-- spc--
	(18, 17, 8, 'DL0', 'Bunga tinggi', 1, NULL),
	(19, 17, 8, 'DL1', 'Terlalu sering dihubungi untuk penawaran produk', 1, NULL),
	(20, 17, 8, 'DL2', 'Sudah punya produk yang sama di Bank lain', 1, NULL),
	(21, 17, 8, 'DL3', 'CH info kartu belum di aktifkan', 1, NULL),
	(22, 17, 8, 'DL5', 'CH keberatan untuk diverifikasi', 1, NULL),
	(23, 17, 8, 'DL6', ' CH info mau tutup/Sudah tutup/belum terima kartu', 1, NULL),
	(24, 17, 8, 'DL7', 'CH info kartunya hilang', 1, NULL),
	(25, 17, 8, 'DL8', 'Tidak mau punya utang atau pinjaman', 1, NULL),
	(26, 17, 8, 'DL9', 'CH langsung tutup telepon setelah greeting', 1, NULL),
	(27, 17, 8, 'DL10', 'Sudah punya produk Pinjaman', 1, NULL),
	(28, 17, 8, 'DL11', 'REJECT UFPRONT', 1, NULL),
	(29, 17, 8, 'DL12', 'DANA TERLALU KECIL', 1, NULL),
	(30, 17, 8, 'DL13', 'Tidak ingin ditelpon/Ditawari program apapun ', 1, NULL),
	(31, 17, 8, 'DL14', 'CH info bunga di bank lain lebih rendah', 1, NULL),
	(32, 17, 8, 'DL15', 'Disagree 2X', 1, NULL),
	(33, 17, 8, 'DL16', 'CH info proses CIP nya lama', 1, NULL),
	(34, 17, 8, 'DL17', 'BELUM ADA KEBUTUHAN', 1, NULL),
	--Multi--
	(35, 20, 8, 'DL0', 'Bunga tinggi', 1, NULL),
	(36, 20, 8, 'DL1', 'Terlalu sering dihubungi untuk penawaran produk', 1, NULL),
	(37, 20, 8, 'DL2', 'Sudah punya produk yang sama di Bank lain', 1, NULL),
	(38, 20, 8, 'DL3', 'CH info kartu belum di aktifkan', 1, NULL),
	(39, 20, 8, 'DL5', 'CH keberatan untuk diverifikasi', 1, NULL),
	(40, 20, 8, 'DL6', ' CH info mau tutup/Sudah tutup/belum terima kartu', 1, NULL),
	(41, 20, 8, 'DL7', 'CH info kartunya hilang', 1, NULL),
	(42, 20, 8, 'DL8', 'Tidak mau punya utang atau pinjaman', 1, NULL),
	(43, 20, 8, 'DL9', 'CH langsung tutup telepon setelah greeting', 1, NULL),
	(44, 20, 8, 'DL10', 'Sudah punya produk Pinjaman', 1, NULL),
	(45, 20, 8, 'DL11', 'REJECT UFPRONT', 1, NULL),
	(46, 20, 8, 'DL12', 'DANA TERLALU KECIL', 1, NULL),
	(47, 20, 8, 'DL13', 'Tidak ingin ditelpon/Ditawari program apapun ', 1, NULL),
	(48, 20, 8, 'DL14', 'CH info bunga di bank lain lebih rendah', 1, NULL),
	(49, 20, 8, 'DL15', 'Disagree 2X', 1, NULL),
	(50, 20, 8, 'DL16', 'CH info proses CIP nya lama', 1, NULL),
	(51, 20, 8, 'DL17', 'BELUM ADA KEBUTUHAN', 1, NULL),
	--dormant--
	(52, 16, 8, 'DL0', 'Bunga tinggi', 1, NULL),
	(53, 16, 8, 'DL1', 'Terlalu sering dihubungi untuk penawaran produk', 1, NULL),
	(54, 16, 8, 'DL2', 'Sudah punya produk yang sama di Bank lain', 1, NULL),
	(55, 16, 8, 'DL3', 'CH info kartu belum di aktifkan', 1, NULL),
	(56, 16, 8, 'DL5', 'CH keberatan untuk diverifikasi', 1, NULL),
	(57, 16, 8, 'DL6', ' CH info mau tutup/Sudah tutup/belum terima kartu', 1, NULL),
	(58, 16, 8, 'DL7', 'CH info kartunya hilang', 1, NULL),
	(59, 16, 8, 'DL8', 'Tidak mau punya utang atau pinjaman', 1, NULL),
	(60, 16, 8, 'DL9', 'CH langsung tutup telepon setelah greeting', 1, NULL),
	(61, 16, 8, 'DL10', 'Sudah punya produk Pinjaman', 1, NULL),
	(62, 16, 8, 'DL11', 'REJECT UFPRONT', 1, NULL),
	(63, 16, 8, 'DL12', 'DANA TERLALU KECIL', 1, NULL),
	(64, 16, 8, 'DL13', 'Tidak ingin ditelpon/Ditawari program apapun ', 1, NULL),
	(65, 16, 8, 'DL14', 'CH info bunga di bank lain lebih rendah', 1, NULL),
	(66, 16, 8, 'DL15', 'Disagree 2X', 1, NULL),
	(67, 16, 8, 'DL16', 'CH info proses CIP nya lama', 1, NULL),
	(68, 16, 8, 'DL17', 'BELUM ADA KEBUTUHAN', 1, NULL),
	--fleksi--
	(69, 9, 8, 'DL0', 'Reject Upfront', 1, NULL),
	(70, 9, 8, 'DL1', 'Bunga Tinggi', 1, NULL),
	(71, 9, 8, 'DL2', 'Promo tidak menarik', 1, NULL),
	(72, 9, 8, 'DL3', 'Setuju kartu flexinya saja', 1, NULL),
	(73, 9, 8, 'DL4', 'Terlalu banyak pinjaman/kartu', 1, NULL),
	(74, 9, 8, 'DL5', ' Kecewa dengan HSBC', 1, NULL),
	(75, 9, 8, 'DL6', 'Tenor terlalu lama', 1, NULL),
	(76, 9, 8, 'DL7', 'Tdk punya NPWP', 1, NULL),
	(77, 9, 8, 'DL8', 'Belum Butuh Pinjaman', 1, NULL),
	(78, 9, 8, 'DL9', 'Limit terlalu Kecil', 1, NULL),
	(79, 9, 8, 'DL10', 'Tidak mau diverifikasi', 1, NULL),
	(80, 9, 8, 'DL11', 'Keberatan/tidak mau pertanyaan CDD', 1, NULL),
	(81, 9, 8, 'DL12', 'Tidak ingin di telpon lagi', 1, NULL),
	(82, 9, 8, 'DL13', 'Keberatan submit KTP', 1, NULL),
	(83, 9, 8, 'DL14', 'Hanya Tertarik PIL', 1, NULL),
	--Pil X Sell
	(84, 5, 8, 'DL0', 'Bunga tinggi', 1, NULL),
	(85, 5, 8, 'DL1', 'Terlalu sering dihubungi untuk penawaran produk', 1, NULL),
	(86, 5, 8, 'DL2', 'Sudah punya produk yang sama di Bank lain', 1, NULL),
	(87, 5, 8, 'DL3', 'Tidak mau ditawari program apapun', 1, NULL),
	(88, 5, 8, 'DL4', 'Reject Upfront', 1, NULL),
	(89, 5, 8, 'DL5', ' CH keberatan untuk diverifikasi', 1, NULL),
	(90, 5, 8, 'DL6', 'Tidak ada promo', 1, NULL),
	(91, 5, 8, 'DL7', 'Tidak mau punya utang atau pinjaman', 1, NULL),
	(92, 5, 8, 'DL8', 'Pinjaman yang diberikan terlalu kecil', 1, NULL),
	(93, 5, 8, 'DL9', 'Belum Ada Kebutuhan', 1, NULL),
	(94, 5, 8, 'DL10', 'Tidak punya/keberatan submit NPWP', 1, NULL),
	(95, 5, 8, 'DL11', 'Keberatan submit KTP', 1, NULL),
	(96, 5, 8, 'DL12', 'Keberatan/tidak mau pertanyaan CDD', 1, NULL),
	(97, 5, 8, 'DL13', 'Cancel PIL karna ditanya CDD', 1, NULL),
	(98, 5, 8, 'DL14', 'Tidak ingin di telpon lagi', 1, NULL),
	-- Pil Top UP--
	(99, 6, 8, 'DL0', 'Bunga tinggi', 1, NULL),
	(100, 6, 8, 'DL1', 'Terlalu sering dihubungi untuk penawaran produk', 1, NULL),
	(101, 6, 8, 'DL2', 'Sudah punya produk yang sama di Bank lain', 1, NULL),
	(102, 6, 8, 'DL3', 'Tidak mau ditawari program apapun', 1, NULL),
	(103, 6, 8, 'DL4', 'Reject Upfront', 1, NULL),
	(104, 6, 8, 'DL5', ' CH keberatan untuk diverifikasi', 1, NULL),
	(105, 6, 8, 'DL6', 'Tidak ada promo', 1, NULL),
	(106, 6, 8, 'DL7', 'Tidak mau punya utang atau pinjaman', 1, NULL)

-- tambahan 16 oktober 2019
ALTER TABLE "dbo"."t_gn_customer"
	ADD "ori_loan_amt" VARCHAR(50) NULL;
EXECUTE sp_addextendedproperty 'MS_Description', 'pertanyaan kedua ver b', 'Schema', 'dbo', 'table', 't_gn_customer', 'column', 'ori_loan_amt';
ALTER TABLE "dbo"."t_gn_customer"
	ADD "old_instalment" VARCHAR(50) NULL;
EXECUTE sp_addextendedproperty 'MS_Description', 'pertanyaan keenam ver b', 'Schema', 'dbo', 'table', 't_gn_customer', 'column', 'old_instalment';
ALTER TABLE "dbo"."t_gn_customer"
	ADD "ssvno" VARCHAR(50) NULL ;
EXECUTE sp_addextendedproperty 'MS_Description', 'pertanyaan keempat ver b', 'Schema', 'dbo', 'table', 't_gn_customer', 'column', 'ssvno';

--tgn ver activity untuk history
ALTER TABLE "dbo"."t_gn_ver_activity"
	ADD "ver_1" VARCHAR(1) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_ver_activity', 'column', 'ver_1';
ALTER TABLE "dbo"."t_gn_ver_activity"
	ADD "ver_2" VARCHAR(1) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_ver_activity', 'column', 'ver_2';
ALTER TABLE "dbo"."t_gn_ver_activity"
	ADD "ver_3" VARCHAR(1) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_ver_activity', 'column', 'ver_3';