-- Hilangin UNIX in table t_gn_loan_tiering di FIELD :
/*CardNo
CampaignId
CustomerId
Tenor*/   
DROP INDEX t_gn_loan_tiering_uniq_key ON hsbcp.dbo.t_gn_loan_tiering

ALTER TABLE "dbo"."t_gn_customer"
	ADD "flag_type" VARCHAR(50) NULL DEFAULT NULL;
EXECUTE sp_addextendedproperty 'MS_Description', '', 'Schema', 'dbo', 'table', 't_gn_customer', 'column', 'flag_type';