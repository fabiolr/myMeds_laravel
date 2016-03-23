# Mymeds

## MyMeds is a platform to share information about Meds by users. 

It is a school project and is not intended to be deployed to production.

Use it at your own risk.

Made in Laravel 5.2

## API DOCUMENTANTION:


### See all Meds Systemwide

`http://mymeds.miami/json/meds`

Returns JSON with objects.


### See all Med Types

`http://mymeds.miami/json/types`

Returns JSON with objects.

### Add a new Type

`http://mymeds.miami/json/types/add`

	parameters:
		type=[type]

Example: http://mymeds.miami/json/type/add?type=analgesic

Returns ID of created type.

### Add New Med

`http://mymeds.miami/json/meds/add`

	parameters:
		type_id=[type id]
		name=[name]
		ingredient=[active ingredient]
		dosage=[dosage] 

Example: http://mymeds.miami/json/med/add?name=Vicodin&type_id=1&ingredient=Hydrocodone&dosage=5mg

Returns ID of created med.