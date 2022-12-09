RUN these commands before use:

PHP artisan migrate


We are an online retailer specialising in technology books. We have a legacy system which
is proving difficult to maintain and currently has no test coverage that we are looking to
replace. We are looking to build a RESTful json API. You have been tasked with developing
a proof of concept that can demonstrate best practices in modern web development with a
focus on designing something which is maintainable and testable.

API Endpoints:

1. /api/upload
    Takes: ISBN,Title,Author,Category and Price
    Returns: ISBN,Title,Author,Category and Price

2. /api/searchData
    Takes: category (optional) and authorName (optional)
    returns: ISBN

3. /api/getCategories
    Takes no parameter
    Returns all categories