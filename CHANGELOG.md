# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.1.2] - 2021-03-05
### Fixed
- `Exporter` UTF-8 encoding. Extra function was added to ensure strict UTF-8 encoding of export files.

## [1.1.1] - 2021-02-02
### Fixed
- `index.php` filepath in case-sensitive environments.

## [1.1.0] - 2021-02-02
### Added
- `Uploader` additional MIME type due to PHP 8 support.

## [1.0.0] - 2021-01-18
### Added
- `DownloadController` provides downloadable files and displays log messages.
- `ErrorController` displays error message if uploaded file not valid.
- `FrontendController` base for other controllers.
- `UploadController` displays home page with upload possibility.
- `Contact` contact presentation.
- `ContactList` holds all contacts models.
- `DataConfig` represents the configuration of the attributes from the two systems.
- `Log` holds all log messages.
- `Dispatcher` single point of request. Redirects tasks to corresponding services and constrollers.
- `Exporter` puts contacts from list into CSV files per language.
- `Importer` creates the contacts and put it to the contact list.
- `Uploader` validates the uploaded file.
