import sys

from configuration import *
from Tools.system_configuration import *
from Tools.commands import *
from os.path import expanduser

# Clone & run SQLs
# Create and clone uploads
#

account = sys.argv[1]
home = expanduser("~")

system_configuration = get_system_configuration()

if has_feature(account, feature_mysql):
    if account in system_configuration:
        if key_configuration_port_mysql in system_configuration[account]:
            mysql_port = system_configuration[account][key_configuration_port_mysql]


