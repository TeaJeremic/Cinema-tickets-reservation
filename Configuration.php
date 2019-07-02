<?php
    final class Configuration {
        const BASE = 'http://localhost/bioskop/';

        const DATABASE_HOST = 'localhost';
        const DATABASE_USER = 'root';
        const DATABASE_PASS = '';
        const DATABASE_NAME = 'bioskop';

        const SESSION_STORAGE_CLASS = '\\App\\Core\\Session\\FileSessionStorage';
        const SESSION_STORAGE_ARGUMENTS = [ './session/' ]; 

        const FINGERPRINT_PROVIDER_CLASS = '\\App\\Core\\Fingerprint\\BasicFingerprintProvider';

        const UPLOAD_DIR = 'assets/uploads/';

        const MAIL_HOST = 'smtp.office365.com';
        const MAIL_PORT = '587';
        const MAIL_PROTOCOL = 'tls';
        const MAIL_USERNAME = 'milan.tair.08@singimail.rs';
        const MAIL_PASSWORD = '**************************';
    }
