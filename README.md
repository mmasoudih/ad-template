## ad-template


### TODO :

- [ ]  change response of add-category (code to status) 



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
