#!/bin/sh

# this will deleted data tmp on web application like GSM FILE 
#/opt/enigma/webapps/bnilifeinsurance2.1.3.r1/application/schedule

BASE_PATH_ROOT="bnilifeinsurance2.1.3.r1"
BASE_PATH_HOME="/opt/enigma/webapps/${BASE_PATH_ROOT}"
BASE_PATH_VOICE="${BASE_PATH_HOME}/application/temp/"
BASE_PATH_RESET="${BASE_PATH_HOME}/index.php Auth ResetLogin"
BASE_DATA_RESET="${BASE_PATH_HOME}/index.php Auth ResetFollowup"
BASE_LAST_CALLS="${BASE_PATH_HOME}/index.php Backdor setup_last_call"

# this will deleted GSM on tmp every day 
# 10 02 * * * root /opt/enigma/webapps/bnilifeinsurance2.1.3.r1/application/schedule/start_deletion_tmp.sh deleted_tmp_gsm

if [ "$1" == "deleted_tmp_gsm" ]; then
  cd $BASE_PATH_VOICE && rm -rf *.wav
  cd $BASE_PATH_VOICE && rm -rf *.gsm
fi

# this will reset agent login on t_lk_user 
# 15 03 * * * root /opt/enigma/webapps/bnilifeinsurance2.1.3.r1/application/schedule/start_deletion_tmp.sh reset_agent_login

if [ "$1" == "reset_agent_login" ]; then
   php -q $BASE_PATH_RESET
fi

# this will reset data gantung  on t_gn_customer
# 15 03 * * * root /opt/enigma/webapps/bnilifeinsurance2.1.3.r1/application/schedule/start_deletion_tmp.sh reset_data_followup

if [ "$1" == "reset_data_followup" ]; then
   php -q $BASE_DATA_RESET
fi

# this will insert t_gn_lastcall for this week
# 15 03 * * * root /opt/enigma/webapps/bnilifeinsurance2.1.3.r1/application/schedule/start_deletion_tmp.sh reset_data_followup

if [ "$1" == "setup_last_call" ]; then
   php -q $BASE_LAST_CALLS
fi
