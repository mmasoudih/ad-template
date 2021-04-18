## ad-template


### TODO :

- [ ]  change response of add-category (code to status) 

- [ ] complete upload picture in ads modal

- [ ] ads management from admin panel 

- [ ] check session exist or no when user call a route ( user wihtout login can see any page now !) 

- [ ] add a loading indicator in the bottom left or any where ( just should be a loading) 

- [ ] hide login modal after success login 

- [ ] make empty all login modal state after close 

- [ ] hide register modal after success register 

- [ ] make empty all register state after close  

- [ ] show validation notifications to user 

- [ ] and much more ... 

### category managemnt APIs

 | URL        | response         |
| :------------- |:-------------:|
| `?api=get-categories` | `{id: 1, title: "cat title"}` 
| `?api=add-categories` | `{message: '...', code: '...'}`
| `?api=update-categories` | `{message: '...', status: '...'}`
| `?api=delete-category` | `{message: '...', status: '...'}`

### users APIs

 | URL        | response         |
| :------------- |:-------------:|
| `?api=get-users` | `{users: [{...},{...}], status: '...'}`
| `?api=toggle-user-status` | `{message: '...', status: '...'}`

### uploader API
 | URL        | response         |
| :------------- |:-------------:|
| `?api=upload` | `{message: '...',file:'FILENAME.ext' status: '...'}`

### save new ads API

 | URL        | response         |
| :------------- |:-------------:|
| `?api=save-ads` | `NOT COMPLETED`
