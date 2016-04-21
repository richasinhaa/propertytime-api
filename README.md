Search
========================


> 1. The Search API is optimized to help you find the specific item you're looking       
>    for (e.g., a specific property by name, list all properties)    
> 2. Implemented using elasticsearch    
> 3. Endpoints to create index, post data (single as well as bulk), Search api's,     
>    Update and delete data    
> 4. Supports keyword search, search in one field, search in all the fields         


####Endpoints#####
1. Fetch all properties
  [GET] api/properties/search  
2. Fetch properties by id  
  [GET] api/properties/search?id=jash  
3. Create Elastisearch Index  
  [POST] api/properties/createindex  
4. Upload single document on elasticsearch  
  [POST] api/properties/postdata  
5. Upload documents in bulk on elasticsearch  
  [POST] api/properties/bulk  
6. Patch a document  
  [PATCH] api/properties/{id}  
7. Delete a document  
  [DELETE] api/properties/{id}  
8. Search for something with a keyword   
  [GET] api/properties/search?search_string=Du  
  [GET] api/properties/search?search_string=Du&search_in=neighbourhood  
  
##Sample request and response##
1. [GET] api/properties/search

'{
properties: [
{
id: "AVQFeSKQBT8lgQqKUw3P",
name: "Shilpa appartment",
developer: "developer1",
agency: "New agency",
neighbourhood: "Dubai",
year: "2004"
},
{
id: "AVQFeSKXBT8lgQqKUw3Q",
name: "Varshini aSD",
developer: "developer2",
agency: "New agency",
neighbourhood: "India",
year: "2010"
},
{
id: "AVQFeSJ_BT8lgQqKUw3O",
name: "Varshini aSD",
developer: "developer3",
agency: "New agency",
neighbourhood: "Mumbai",
year: "2004"
}
]
}'

2. [GET] api/properties/search?id=AVQFeSKQBT8lgQqKUw3P

`{
properties: {
id: "AVQFeSKQBT8lgQqKUw3P",
name: "Shilpa appartment",
developer: "developer1",
agency: "New agency",
neighbourhood: "Dubai",
year: "2004"
}
}'

