module.exports = {
	//"connection": "http",
	//"address": "127.0.0.1:8881",
	"connection": "unix-socket",
	"address": "./rlogtail.sock",
	"plugins": [
		new (require('./node_modules/rlogtail/src/plugins/dump.js'))('dump', 'd', 'Dump', true),
		new (require('./node_modules/rlogtail/src/plugins/sql.js'))('sql', 's', 'Sql', false),
		new (require('./node_modules/rlogtail/src/plugins/sql-error.js'))('sql_error', 'q', 'Sql Error', true),
		new (require('./node_modules/rlogtail/src/plugins/error.js'))('error', 'e', 'Error', true),
		new (require('./node_modules/rlogtail/src/plugins/exception.js'))('exception', 'x', 'Exception', true),
		new (require('./node_modules/rlogtail/src/plugins/trace.js'))('trace', 't', 'Trace', false),
	]
}