# UK Public Holidays

PHP package to determine whether a given date is a public holiday in the UK.

Public holiday data is from [gov.uk](https://www.gov.uk/bank-holidays.json)

## Example

```php
Date::isHoliday(Carbon::today());
Date::isWorkingDay(Carbon::today())
Date::nextWorkingDay();
Date::previousWorkingDay();
```

## Regions

The default region is 'England and Wales'. To change it use `PublicHolidays::setRegion()`:

```php
PublicHolidays::setRegion('scotland');
PublicHolidays::setRegion('northern-ireland');
```
