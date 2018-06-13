import sys

from configuration import *
from Tools.system_configuration import *
from Tools.commands import *
from os.path import expanduser

# Clone & run SQLs
# Create and clone uploads
#

url = sys.argv[2]
account = sys.argv[1]
home = expanduser("~")
mysql_port = default_port_mysql

system_configuration = get_system_configuration()

if has_feature(account, feature_mysql):
    if account in system_configuration:
        if key_configuration_port_mysql in system_configuration[account]:
            mysql_port = system_configuration[account][key_configuration_port_mysql]

    # TODO: Execute SQL.

    mysql_host_full = mysql_host + ":" + str(mysql_port)

    steps = [
        python(
            "Tools/" + wipe_script,
            content_dir_path(home) + "/" + url + "/Matrices/wp-config.php.matrix",
            content_dir_path(home) + "/" + url + "/Content/wp-config.php",
            config_matrix_db_host, mysql_host_full,
            # httpd_conf_matrix_port_placeholder, str(system_configuration[account][key_configuration_port]),
        )
    ]

    run(steps)
