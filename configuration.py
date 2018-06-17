import random
import string

from Tools.configuration import *

db_name = "mvasic_maja"
mysql_host = "127.0.0.1"

config_matrix_db = "CONFIG_MATRIX_DB"
config_matrix_db_user = "CONFIG_MATRIX_DB_USER"
config_matrix_db_host = "CONFIG_MATRIX_DB_HOST"
config_matrix_db_password = "CONFIG_MATRIX_DB_PASSWORD"

conf_salt_length = len("azaeiiz1kakq5znx2vk6golk0uhusmoxsngc3balwgbbt9ujubrwx0bmukb5djg4")
config_matrix_auth_key = "CONFIG_MATRIX_AUTH_KEY"
config_matrix_secure_auth_key = "CONFIG_MATRIX_SECURE_AUTH_KEY"
config_matrix_logged_in_key = "CONFIG_MATRIX_LOGGED_IN_KEY"
config_matrix_nonce_key = "CONFIG_MATRIX_NONCE_KEY"
config_matrix_auth_salt = "CONFIG_MATRIX_AUTH_SALT"
config_matrix_secure_auth_salt = "CONFIG_MATRIX_SECURE_AUTH_SALT"
config_matrix_logged_in_salt = "CONFIG_MATRIX_LOGGED_IN_SALT"
config_matrix_nonce_salt = "CONFIG_MATRIX_NONCE_SALT"

# FIXME: Port is missing.
config_matrix_sql_init_main_url = "CONFIG_MATRIX_SQL_INIT_MAIN_URL"
config_matrix_sql_init_content_root = "CONFIG_MATRIX_SQL_INIT_CONTENT_ROOT"
config_matrix_sql_init_content_dir = "CONFIG_MATRIX_SQL_INIT_CONTENT_DIR"


def get_random_string():
    alphabet = string.ascii_letters + string.digits
    return ''.join(random.choice(alphabet) for i in range(conf_salt_length))