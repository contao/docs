class initEnvConverterTools {
  constructor() {
    this.databaseUrl = document.getElementById('database_url');
    this.databaseUser = document.getElementById('database_user');
    this.databasePassword = document.getElementById('database_password');
    this.databaseServer = document.getElementById('database_host');
    this.databaseName = document.getElementById('database_name');

    this.validating = false;
    this.urlPattern = '^([^:]+)://(([^:@]+)(:([^@]+))?@)?([^:/]+(:[0-9]+)?)/([^?]+)(\\?.+)?$';

    if (
      this.databaseUrl &&
      this.databaseUser &&
      this.databasePassword &&
      this.databaseServer &&
      this.databaseName
    ) {
      this._initDatabaseFields();
    }

    this.mailerUser = document.getElementById('mailer_user');
    this.mailerPassword = document.getElementById('mailer_password');
    this.mailerHost = document.getElementById('mailer_host');
    this.mailerPort = document.getElementById('mailer_port');

    this.mailerDsn = document.getElementById('mailer_dsn');
    this.mailerConfig = document.getElementById('mail_config_value');

    if (
      this.mailerUser &&
      this.mailerPassword &&
      this.mailerHost &&
      this.mailerPort &&
      this.mailerDsn &&
      this.mailerConfig
    ) {
      this._initMailerFields();
    }
  }

  _initDatabaseFields() {
    [this.databaseUrl, this.databaseUser, this.databasePassword, this.databaseServer, this.databaseName].forEach((input) => {
      if (input === this.databaseUrl) {
        input.addEventListener('blur', this._parseDatabaseUrl.bind(this));
      } else {
        input.addEventListener('input', this._updateDatabaseUrl.bind(this));
      }
    })
  }

  _initMailerFields() {
    [this.mailerUser, this.mailerPassword, this.mailerHost, this.mailerPort].forEach((input) => {
      input.addEventListener('input', this._updateMailerDsn.bind(this));
    })
  }

  _parseDatabaseUrl() {
    if (!this._validateDatabaseUrl()) {
      return;
    }

    this.validating = true;

    const match = new RegExp(this.urlPattern, 'i').exec(this.databaseUrl.value);

    this.databaseUser.value = match[3] ? decodeURIComponent(match[3]) : '';
    this.databasePassword.value = match[5] ? decodeURIComponent(match[5]) : '';
    this.databaseServer.value = decodeURIComponent(match[6]);
    this.databaseName.value = decodeURIComponent(match[8]);

    if (this.databaseServer.value.substring(this.databaseServer.value.length - 5) === ':3306') {
      this.databaseServer.value = this.databaseServer.value.substring(0, this.databaseServer.value.length - 5);
    } else if (!this.databaseServer.value.includes(':')) {
      this.databaseServer.value = `${this.databaseServer.value}:3306`;
    }

    this.validating = false;
  }

  _updateDatabaseUrl() {
    if (this.validating) {
      return;
    }

    if (!this.databaseServer.value) {
      return;
    }

    const serverParts = this.databaseServer.value.split(':', 2);
    const server = `${encodeURIComponent(serverParts[0])}:${serverParts[1] || '3306'}`;

    let url = 'mysql://';

    if (this.databaseUser.value) {
      url += encodeURIComponent(this.databaseUser.value);

      if (this.databasePassword.value) {
        url += ':' + encodeURIComponent(this.databasePassword.value);
      }

      url += '@';
    }

    url += server;

    if (this.databaseName.value) {
      url += '/' + encodeURIComponent(this.databaseName.value);
    }

    this.databaseUrl.value = url;
  }

  _validateDatabaseUrl() {
    if (this.databaseUrl.value === '') {
      return false;
    }

    return new RegExp(this.urlPattern, 'i').test(this.databaseUrl.value);
  }

  _updateMailerDsn() {
    if (!this.mailerHost.value) {
      return;
    }

    let mailer_dsn = 'smtp://';

    if (this.mailerUser.value) {
      mailer_dsn += encodeURIComponent(this.mailerUser.value);

      if (this.mailerPassword.value) {
        mailer_dsn += ':' + encodeURIComponent(this.mailerPassword.value);
      }

      mailer_dsn += '@';
    }

    mailer_dsn += encodeURIComponent(this.mailerHost.value);

    if (this.mailerPort.value) {
      mailer_dsn += ':' + this.mailerPort.value;
    }

    this.mailerDsn.value = mailer_dsn;
    this.mailerConfig.value = mailer_dsn.replaceAll('%', '%%');
  }
}

window.onload = () => { new initEnvConverterTools }
