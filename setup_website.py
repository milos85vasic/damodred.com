import sys

from Tools.system_configuration import *
from Tools.commands import *
from Tools.mysql_common import *
from configuration import *
from os.path import expanduser

url = sys.argv[2]
account = sys.argv[1]
home = expanduser("~")
mysql_port = default_port_mysql

system_configuration = get_system_configuration()

if has_feature(account, feature_mysql):
    if account in system_configuration:
        if key_configuration_port_mysql in system_configuration[account]:
            mysql_port = system_configuration[account][key_configuration_port_mysql]

    mysql_password = "undefined"

    steps = [
        get_mysql_bin_directory() + "/mysql --host=" + mysql_host + " --port=" + mysql_port + " --user=root" +
        " --password=" + mysql_password + " < " + content_dir_path(home) + "/" + url + "/SQL/init.sql"
    ]

    run(steps)

    mysql_host_full = mysql_host + ":" + str(mysql_port)
    if account in system_configuration:
        if key_services in system_configuration[account]:
            if key_credentials in system_configuration[account][key_services]:
                if feature_mysql in system_configuration[account][key_services][key_credentials]:
                    mysql_password = system_configuration[account][key_services][key_credentials][feature_mysql]

    steps = [
        python(
            "Tools/" + wipe_script,
            content_dir_path(home) + "/" + url + "/Matrices/wp-config.php.matrix",
            content_dir_path(home) + "/" + url + "/Content/wp-config.php",
            config_matrix_db_host, mysql_host_full,
            config_matrix_db, db_name,
            config_matrix_db_user, account,
            config_matrix_db_password, mysql_password
        )
    ]

    run(steps)
