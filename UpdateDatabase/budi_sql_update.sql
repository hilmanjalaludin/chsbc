-- tgn_template yg lama backup, kemudian buat lagi :
CREATE TABLE IF NOT EXISTS "t_gn_template" (
	"TemplateId" INT(10,0) NOT NULL,
	"TemplateTableName" VARCHAR(50) NOT NULL DEFAULT ('0'),
	"TemplateName" VARCHAR(200) NULL DEFAULT NULL,
	"TemplateMode" VARCHAR(200) NULL DEFAULT NULL,
	"TemplateFileType" CHAR(10) NULL DEFAULT NULL,
	"TemplateSparator" VARCHAR(20) NULL DEFAULT NULL,
	"TemplateBlacklist" VARCHAR(1) NULL DEFAULT ('Y'),
	"TemplateLimitDays" INT(10,0) NULL DEFAULT ((0)),
	"TemplateBucket" VARCHAR(1) NULL DEFAULT ('N'),
	"TemplateFlags" TINYINT(3,0) NULL DEFAULT ((1)),
	"TemplateModul" VARCHAR(200) NULL DEFAULT NULL,
	"TemplateCreateTs" DATETIME2(7) NULL DEFAULT NULL,
	PRIMARY KEY ("TemplateId")
);
INSERT INTO "t_gn_template" ("TemplateId", "TemplateTableName", "TemplateName", "TemplateMode", "TemplateFileType", "TemplateSparator", "TemplateBlacklist", "TemplateLimitDays", "TemplateBucket", "TemplateFlags", "TemplateModul", "TemplateCreateTs") VALUES
	(1, 't_gn_attr_cip_reg', 'CIP REGULER', 'insert', 'excel     ', NULL, 'N', NULL, 'N', 1, 'U_Cip_Reguler', '2016-06-21 00:50:44.0000000'),
	(2, 't_gn_attr_cip_cc', 'CIP CC', 'insert', 'excel     ', NULL, 'N', NULL, 'N', 1, 'U_Cip_Reguler', '2016-06-21 00:50:44.0000000'),
	(3, 't_gn_attr_cip_ntb', 'CIP NTB', 'insert', 'excel     ', NULL, 'N', NULL, 'N', 1, 'U_Cip_Reguler', '2016-06-21 00:50:44.0000000'),
	(4, 't_gn_attr_cip_topup', 'CIP TOPUP', 'insert', 'excel     ', NULL, 'N', NULL, 'N', 1, 'U_Cip_Reguler', '2016-06-21 00:50:44.0000000'),
	(5, 't_gn_attr_pil_xsell', 'PIL XSELL', 'insert', 'excel     ', NULL, 'N', NULL, 'Y', 1, 'U_Pil_Xsel', '2016-06-21 00:50:44.0000000'),
	(6, 't_gn_attr_pil_topup', 'PIL TOPUP', 'insert', 'excel     ', NULL, 'N', NULL, 'Y', 1, 'U_Pil_Topup', '2016-06-21 00:50:44.0000000'),
	(7, 't_gn_attr_hospin', 'HOSPIN', 'insert', 'excel     ', NULL, 'N', NULL, 'N', 1, 'U_Cip_Reguler', '2016-06-21 00:50:44.0000000'),
	(8, 't_gn_attr_pa', 'PA', 'insert', 'excel     ', NULL, 'N', NULL, 'N', 1, 'U_Cip_Reguler', '2016-06-21 00:50:44.0000000'),
	(9, 't_gn_attr_flexi', 'FLEXI', 'insert', 'excel     ', NULL, 'N', NULL, 'Y', 1, 'U_Flexi', '2016-06-21 00:50:44.0000000'),
	(10, 't_gn_attr_cip_dormant', 'CIP DORMANT', 'insert', 'excel     ', NULL, 'N', NULL, 'N', 1, 'U_Cip_Reguler', '2016-06-21 00:50:44.0000000'),
	(11, 't_gn_attr_cip_spc', 'CIP SPC', 'insert', 'excel     ', NULL, 'N', NULL, 'N', 1, 'U_Cip_Reguler', '2019-10-14 07:52:31.0000000'),
	(12, 't_gn_attr_cip_mlt', 'CIP MLT', 'insert', 'excel     ', NULL, 'N', NULL, 'N', 1, 'U_Cip_Reguler', '2019-10-14 07:52:31.0000000');
-- END tgn_template yg lama backup, kemudian buat lagi :


-- tgl 11-10-2019: t_gn_attr_cip_reg
ALTER TABLE "dbo"."t_gn_attr_cip_reg"
	ADD "Tenor5" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_reg', 'column', 'Tenor5';
ALTER TABLE "dbo"."t_gn_attr_cip_reg"
	ADD "Rate5" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_reg', 'column', 'Rate5';
ALTER TABLE "dbo"."t_gn_attr_cip_reg"
	ADD "Month_ins_24_1" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_reg', 'column', 'Month_ins_24_1';
ALTER TABLE "dbo"."t_gn_attr_cip_reg"
	ADD "Month_ins_24_2" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_reg', 'column', 'Month_ins_24_2';
ALTER TABLE "dbo"."t_gn_attr_cip_reg"
	ADD "Month_ins_24_3" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_reg', 'column', 'Month_ins_24_3';
ALTER TABLE "dbo"."t_gn_attr_cip_reg"
	ADD "Month_ins_24_4" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_reg', 'column', 'Month_ins_24_4';
ALTER TABLE "dbo"."t_gn_attr_cip_reg"
	ADD "Admin_Fee_T4_1" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_reg', 'column', 'Admin_Fee_T4_1';
ALTER TABLE "dbo"."t_gn_attr_cip_reg"
	ADD "Admin_Fee_T4_2" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_reg', 'column', 'Admin_Fee_T4_2';
ALTER TABLE "dbo"."t_gn_attr_cip_reg"
	ADD "Admin_Fee_T4_3" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_reg', 'column', 'Admin_Fee_T4_3';
ALTER TABLE "dbo"."t_gn_attr_cip_reg"
	ADD "Admin_Fee_T4_4" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_reg', 'column', 'Admin_Fee_T4_4';
ALTER TABLE "dbo"."t_gn_attr_cip_reg"
	ADD "Recsource" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_reg', 'column', 'Recsource';
ALTER TABLE "dbo"."t_gn_attr_cip_reg"
	ADD "count_of_supplement" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_reg', 'column', 'count_of_supplement';
ALTER TABLE "dbo"."t_gn_attr_cip_reg"
	ADD "count_of_primary_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_reg', 'column', 'count_of_primary_card';
ALTER TABLE "dbo"."t_gn_attr_cip_reg"
	ADD "Classic_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_reg', 'column', 'Classic_card';
ALTER TABLE "dbo"."t_gn_attr_cip_reg"
	ADD "Gold_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_reg', 'column', 'Gold_card';
ALTER TABLE "dbo"."t_gn_attr_cip_reg"
	ADD "Cashback_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_reg', 'column', 'Cashback_card';
ALTER TABLE "dbo"."t_gn_attr_cip_reg"
	ADD "Platinum_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_reg', 'column', 'Platinum_card';
ALTER TABLE "dbo"."t_gn_attr_cip_reg"
	ADD "Signature_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_reg', 'column', 'Signature_card';
ALTER TABLE "dbo"."t_gn_attr_cip_reg"
	ADD "Premier_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_reg', 'column', 'Premier_card';
-- END tgl 11-10-2019: t_gn_attr_cip_reg

-- tgl 11-10-2019: t_gn_detail_template regular
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (1, 'Tenor5', '', 'Tenor5', 75, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (1, 'Rate5', '', 'Rate5', 76, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (1, 'Month_ins_24_1', '', 'Month_ins_24_1', 77, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (1, 'Month_ins_24_2', '', 'Month_ins_24_2', 78, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (1, 'Month_ins_24_3', '', 'Month_ins_24_3', 79, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (1, 'Month_ins_24_4', '', 'Month_ins_24_4', 80, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (1, 'Admin_Fee_T4_1', '', 'Admin_Fee_T4_1', 81, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (1, 'Admin_Fee_T4_2', '', 'Admin_Fee_T4_2', 82, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (1, 'Admin_Fee_T4_3', '', 'Admin_Fee_T4_3', 83, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (1, 'Admin_Fee_T4_4', '', 'Admin_Fee_T4_4', 84, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (1, 'Recsource', '', 'Recsource', 85, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (1, 'count_of_supplement', '', 'count_of_supplement', 86, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (1, 'count_of_primary_card', '', 'count_of_primary_card', 87, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (1, 'Classic_card', '', 'Classic_card', 88, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (1, 'Gold_card', '', 'Gold_card', 89, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (1, 'Cashback_card', '', 'Cashback_card', 90, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (1, 'Platinum_card', '', 'Platinum_card', 91, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (1, 'Signature_card', '', 'Signature_card', 92, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (1, 'Premier_card', '', 'Premier_card', 93, NULL);
-- END tgl 11-10-2019: t_gn_detail_template regular


-- tgl 11-10-2019: t_gn_attr_cip_cc
ALTER TABLE "dbo"."t_gn_attr_cip_cc"
	ADD "Recsource" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_cc', 'column', 'Recsource';
ALTER TABLE "dbo"."t_gn_attr_cip_cc"
	ADD "count_of_supplement" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_cc', 'column', 'count_of_supplement';
ALTER TABLE "dbo"."t_gn_attr_cip_cc"
	ADD "count_of_primary_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_cc', 'column', 'count_of_primary_card';
ALTER TABLE "dbo"."t_gn_attr_cip_cc"
	ADD "Classic_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_cc', 'column', 'Classic_card';
ALTER TABLE "dbo"."t_gn_attr_cip_cc"
	ADD "Gold_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_cc', 'column', 'Gold_card';
ALTER TABLE "dbo"."t_gn_attr_cip_cc"
	ADD "Cashback_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_cc', 'column', 'Cashback_card';
ALTER TABLE "dbo"."t_gn_attr_cip_cc"
	ADD "Platinum_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_cc', 'column', 'Platinum_card';
ALTER TABLE "dbo"."t_gn_attr_cip_cc"
	ADD "Signature_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_cc', 'column', 'Signature_card';
ALTER TABLE "dbo"."t_gn_attr_cip_cc"
	ADD "Premier_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_cc', 'column', 'Premier_card'; 
-- END tgl 11-10-2019: t_gn_attr_cip_cc

-- tgl 11-10-2019: t_gn_detail_template cc
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (2, 'Recsource', '', 'Recsource', 105, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (2, 'count_of_supplement', '', 'count_of_supplement', 106, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (2, 'Classic_card', '', 'Classic_card', 107, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (2, 'Gold_card', '', 'Gold_card', 108, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (2, 'Cashback_card', '', 'Cashback_card', 109, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (2, 'Platinum_card', '', 'Platinum_card', 110, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (2, 'Signature_card', '', 'Signature_card', 111, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (2, 'Premier_card', '', 'Premier_card', 112, NULL);
--END tgl 11-10-2019: t_gn_detail_template cc

-- UBAH Recsources jdi Recsource :  t_gn_detail_template
UPDATE "t_gn_detail_template" SET "UploadColsName"='Recsource', "UploadColsAlias"='Recsource' 
WHERE  "Id"=1008 
AND "UploadTmpId"=12 
AND "UploadColsName"='Recsources';

-- t_gn_detail template : CIP_NTB
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Cardno', '', 'Cardno', 1, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'accno', '', 'accno', 2, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Name', '', 'Name', 3, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'DOB', '', 'DOB', 4, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Limit', '', 'Limit', 5, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'balance', '', 'balance', 6, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'phone1', '', 'phone1', 7, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'phone2', '', 'phone2', 8, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'MOBILE', '', 'MOBILE', 9, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'prod', '', 'prod', 10, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'cycle', '', 'cycle', 11, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'UTILISATION', '', 'UTILISATION', 12, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'DUE_DATE', '', 'DUE_DATE', 13, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'GENERATION_DT', '', 'GENERATION_DT', 14, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Dbase_Expire_dt', '', 'Dbase_Expire_dt', 15, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'card_expr_txt', '', 'card_expr_txt', 16, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'addr1', '', 'addr1', 17, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'addr2', '', 'addr2', 18, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'addr3', '', 'addr3', 19, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'addr4', '', 'addr4', 20, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'zip', '', 'zip', 21, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'tier1', '', 'tier1', 22, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'tier2', '', 'tier2', 23, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'tier3', '', 'tier3', 24, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'tier4', '', 'tier4', 25, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'limit_band', '', 'limit_band', 26, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'refno', '', 'refno', 27, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Tenor1', '', 'Tenor1', 28, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Rate1', '', 'Rate1', 29, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Tenor2', '', 'Tenor2', 30, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Rate2', '', 'Rate2', 31, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Tenor3', '', 'Tenor3', 32, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Rate3', '', 'Rate3', 33, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Month_ins_06_1', '', 'Month_ins_06_1', 34, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Month_ins_06_2', '', 'Month_ins_06_2', 35, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Month_ins_06_3', '', 'Month_ins_06_3', 36, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Month_ins_06_4', '', 'Month_ins_06_4', 37, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Month_ins_12_1', '', 'Month_ins_12_1', 38, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Month_ins_12_2', '', 'Month_ins_12_2', 39, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Month_ins_12_3', '', 'Month_ins_12_3', 40, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Month_ins_12_4', '', 'Month_ins_12_4', 41, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Month_ins_18_1', '', 'Month_ins_18_1', 42, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Month_ins_18_2', '', 'Month_ins_18_2', 43, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Month_ins_18_3', '', 'Month_ins_18_3', 44, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Month_ins_18_4', '', 'Month_ins_18_4', 45, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Start_Tele', '', 'Start_Tele', 46, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'End_Tele', '', 'End_Tele', 47, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'CIP_TYPE', '', 'CIP_TYPE', 48, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Custno1', '', 'Custno1', 49, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Free_Interest_T18_1', '', 'Free_Interest_T18_1', 50, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Free_Interest_T18_2', '', 'Free_Interest_T18_2', 51, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Free_Interest_T18_3', '', 'Free_Interest_T18_3', 52, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Free_Interest_T18_4', '', 'Free_Interest_T18_4', 53, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Free_Interest_T24_1', '', 'Free_Interest_T24_1', 54, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Free_Interest_T24_2', '', 'Free_Interest_T24_2', 55, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Free_Interest_T24_3', '', 'Free_Interest_T24_3', 56, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Free_Interest_T24_4', '', 'Free_Interest_T24_4', 57, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Admin_Fee_T3_1', '', 'Admin_Fee_T3_1', 58, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Admin_Fee_T3_2', '', 'Admin_Fee_T3_2', 59, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Admin_Fee_T3_3', '', 'Admin_Fee_T3_3', 60, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Admin_Fee_T3_4', '', 'Admin_Fee_T3_4', 61, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Month_ins_03_1', '', 'Month_ins_03_1', 62, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Month_ins_03_2', '', 'Month_ins_03_2', 63, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Month_ins_03_3', '', 'Month_ins_03_3', 64, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Month_ins_03_4', '', 'Month_ins_03_4', 65, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Tenor4', '', 'Tenor4', 66, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Rate4', '', 'Rate4', 67, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Sex', '', 'Sex', 68, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'occupation', '', 'occupation', 69, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'flag_supplement', '', 'flag_supplement', 70, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Billing_Address', '', 'Billing_Address', 71, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'flag_bestbill', '', 'flag_bestbill', 72, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'flag_area', '', 'flag_area', 73, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'propensity_CIP', '', 'propensity_CIP', 74, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Tenor5', '', 'Tenor5', 75, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Rate5', '', 'Rate5', 76, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Month_ins_24_1', '', 'Month_ins_24_1', 77, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Month_ins_24_2', '', 'Month_ins_24_2', 78, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Month_ins_24_3', '', 'Month_ins_24_3', 79, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Month_ins_24_4', '', 'Month_ins_24_4', 80, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Admin_Fee_T4_1', '', 'Admin_Fee_T4_1', 81, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Admin_Fee_T4_2', '', 'Admin_Fee_T4_2', 82, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Admin_Fee_T4_3', '', 'Admin_Fee_T4_3', 83, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Admin_Fee_T4_4', '', 'Admin_Fee_T4_4', 84, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Recsource', '', 'Recsource', 85, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'count_of_supplement', '', 'count_of_supplement', 86, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'count_of_primary_card', '', 'count_of_primary_card', 87, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Classic_card', '', 'Classic_card', 88, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Gold_card', '', 'Gold_card', 89, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Cashback_card', '', 'Cashback_card', 90, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Platinum_card', '', 'Platinum_card', 91, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Signature_card', '', 'Signature_card', 92, NULL);
INSERT INTO "t_gn_detail_template" ("UploadTmpId", "UploadColsName", "UploadKeys", "UploadColsAlias", "UploadColsOrder", "UploadsColsFunction") VALUES (3, 'Premier_card', '', 'Premier_card', 93, NULL);

-- ADD COLOMS IN TABLE t_gn_attr_cip_ntb :
ALTER TABLE "dbo"."t_gn_attr_cip_ntb"
	ADD "propensity_CIP" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_ntb', 'column', 'propensity_CIP';
ALTER TABLE "dbo"."t_gn_attr_cip_ntb"
	ADD "Tenor5" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_ntb', 'column', 'Tenor5';
ALTER TABLE "dbo"."t_gn_attr_cip_ntb"
	ADD "Rate5" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_ntb', 'column', 'Rate5';
ALTER TABLE "dbo"."t_gn_attr_cip_ntb"
	ADD "Month_ins_24_1" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_ntb', 'column', 'Month_ins_24_1';
ALTER TABLE "dbo"."t_gn_attr_cip_ntb"
	ADD "Month_ins_24_2" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_ntb', 'column', 'Month_ins_24_2';
ALTER TABLE "dbo"."t_gn_attr_cip_ntb"
	ADD "Month_ins_24_3" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_ntb', 'column', 'Month_ins_24_3';
ALTER TABLE "dbo"."t_gn_attr_cip_ntb"
	ADD "Month_ins_24_4" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_ntb', 'column', 'Month_ins_24_4';
ALTER TABLE "dbo"."t_gn_attr_cip_ntb"
	ADD "Admin_Fee_T4_1" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_ntb', 'column', 'Admin_Fee_T4_1';
ALTER TABLE "dbo"."t_gn_attr_cip_ntb"
	ADD "Admin_Fee_T4_2" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_ntb', 'column', 'Admin_Fee_T4_2';
ALTER TABLE "dbo"."t_gn_attr_cip_ntb"
	ADD "Admin_Fee_T4_3" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_ntb', 'column', 'Admin_Fee_T4_3';
ALTER TABLE "dbo"."t_gn_attr_cip_ntb"
	ADD "Admin_Fee_T4_4" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_ntb', 'column', 'Admin_Fee_T4_4';
ALTER TABLE "dbo"."t_gn_attr_cip_ntb"
	ADD "Recsource" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_ntb', 'column', 'Recsource';
ALTER TABLE "dbo"."t_gn_attr_cip_ntb"
	ADD "count_of_supplement" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_ntb', 'column', 'count_of_supplement';
ALTER TABLE "dbo"."t_gn_attr_cip_ntb"
	ADD "count_of_primary_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_ntb', 'column', 'count_of_primary_card';
ALTER TABLE "dbo"."t_gn_attr_cip_ntb"
	ADD "Classic_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_ntb', 'column', 'Classic_card';
ALTER TABLE "dbo"."t_gn_attr_cip_ntb"
	ADD "Gold_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_ntb', 'column', 'Gold_card';
ALTER TABLE "dbo"."t_gn_attr_cip_ntb"
	ADD "Cashback_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_ntb', 'column', 'Cashback_card';
ALTER TABLE "dbo"."t_gn_attr_cip_ntb"
	ADD "Platinum_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_ntb', 'column', 'Platinum_card';
ALTER TABLE "dbo"."t_gn_attr_cip_ntb"
	ADD "Signature_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_ntb', 'column', 'Signature_card';
ALTER TABLE "dbo"."t_gn_attr_cip_ntb"
	ADD "Premier_card" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_attr_cip_ntb', 'column', 'Premier_card';

--Ubah Di tgn_detail_template untuk template CIP Dormant: Recsources jadi Recsource
UPDATE "hsbcp"."dbo"."t_gn_detail_template" 
SET "UploadColsName"='Recsource', "UploadColsAlias"='Recsource' 
WHERE  "Id"=822 AND "UploadTmpId"=10 AND "UploadColsName"='Recsources';

--Ubah Di tgn_detail_template untuk template CIP SPC: Recsources jadi Recsource
UPDATE "hsbcp"."dbo"."t_gn_detail_template" 
SET "UploadColsName"='Recsource', "UploadColsAlias"='Recsource' 
WHERE  "Id"=915 AND "UploadTmpId"=11 AND "UploadColsName"='Recsources';