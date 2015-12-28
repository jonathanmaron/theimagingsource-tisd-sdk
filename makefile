
#
# Paths
#

PATH_DOCUMENT_ROOT	:= .

#
# Enforce PHP coding standards
#

cs:
	cd $(PATH_DOCUMENT_ROOT) && php-cs-fixer fix --config-file=.php_cs -vvv --diff
	cd $(PATH_DOCUMENT_ROOT) && rm -frv .php_cs.cache

cs-dry-run:
	cd $(PATH_DOCUMENT_ROOT) && php-cs-fixer fix --config-file=.php_cs -vvv --diff --dry-run
	cd $(PATH_DOCUMENT_ROOT) && rm -frv .php_cs.cache
