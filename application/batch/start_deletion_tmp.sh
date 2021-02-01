#!/bin/sh

# this will deleted data tmp on web application like GSM FILE 

BASE_PATH_ROOT="hsbc-portof"
BASE_PATH_HOME="/opt/enigma/webapps/${BASE_PATH_ROOT}"
BASE_PATH_VOICE="${BASE_PATH_HOME}/application/temp/"
BASE_PATH_RESET="${BASE_PATH_HOME}/index.php Auth ResetLogin"

BASE_PATH_DELETE="${BASE_PATH_HOME}/index.php Auth DeleteBatchService3Month"
BASE_PATH_EXPIRED_KNOWLEDGE="${BASE_PATH_HOME}/index.php Auth ExpiredKnowledge"

# this will deleted GSM on tmp every day 
# 10 02 * * * root /opt/enigma/webapps/hsbctele3.1.3.r2/application/batch/start_deletion.sh deleted_tmp_gsm

if [ "$1" == "deleted_tmp_gsm" ]; then
  cd $BASE_PATH_VOICE && rm -rf *.gsm
  cd $BASE_PATH_VOICE && rm -rf *.wav
fi

# this will reset agent login on t_lk_user 
# 15 03 * * * root /opt/enigma/webapps/hsbctele3.1.3.r2/application/batch/start_deletion.sh reset_agent_login

if [ "$1" == "reset_agent_login" ]; then
   php -q $BASE_PATH_RESET
fi

# this will reset agent login on t_gn_batch_service 
# 30 03 * * * root /opt/enigma/webapps/hsbctele3.1.3.r2/application/batch/start_deletion.sh rmove_batch_3month

if [ "$1" == "rmove_batch_3month" ]; then
   php -q $BASE_PATH_DELETE
fi


# this will reset agent login on t_gn_batch_service 
# 30 03 * * * root /opt/enigma/webapps/helpdesk4.1.2.1.1/application/batch/start_deletion.sh expired_batch_knowledge

if [ "$1" == "expired_batch_knowledge" ]; then
   php -q $BASE_PATH_EXPIRED_KNOWLEDGE
fi





