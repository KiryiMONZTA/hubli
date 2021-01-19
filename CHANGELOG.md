# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

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
