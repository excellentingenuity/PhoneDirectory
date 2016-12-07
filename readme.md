# Phone Directory
The phone directory is a single page demo application. 
The application has no authentication or management for multi-user editing.
If this application was to be put in a live production environment a push 
notification system would be needed to allow the server to inform the frontend
that a change has been made. Additionally, other than just being required, validation of
the input before sending to the server would be made along with displaying any appropriate
flash messages for errors or success.

## Tools
- Backend Framework: Laravel 5.3
- Frontend Framework: Vue.js 2

## Production TO-DO's
- Server Push Notifications of list change
- Separate the API to an its own sub-domain
- Flash Messages on the UI
- Input Validation
- Authentication (at least for new, edit, and delete) with the auth service on its own sub-domain
- Admin Dashboard for rolling back and replaying Domain Events
- Separate DB Server from App server for scaling up
- Separate Auth, API, and the application to separate servers for scaling up
- Implement the replay of Domain Events
- Separate out the page scss and abstract the entry list to a scss component
- Make a colors.scss file with the thematic colors of the app
- Make the Entry Card a Vue Component
- Add more edge cases to tests, that are not as present with the limited UI and Resource Routing

## Comments

### Static Proxy Manager
I used a static proxy (App\Entries\Manager) as a quasi-repository to maintain a unified API to the event listeners and EntryController. The Manger additionally affords for creating and returning complex aggregate objects from the Manager level to the Controller as the application grows in complexity without over complicating the Entity Model. I have found this method to afford great flexibility especially with the Laravel Framework without over abstracting with a fully injected repository.

### Domain Events
I used a Domain Event setup (App\DomainEvents) to capture native Laravel Events and record them
to a table in the database loosely following the Event Sourcing practices. Using Event Sourcing instantly adds queryable logging and metrics instantly. A slight level of complexity is introduced at the Controller level requiring a 
retrieval call to the Manger to get the object to return. However, it does reduce some complexity in the Controller by allowing the Event object to do any data transformations
before it gets to the Manager level.

### Directory Structure
Under the app directory, my practice is to place each sub-system in its own folder. Thus the Entry Model, Manager, Factory, etc. are all in an Entries directory below app. If authentication was used, the User Model would likewise move to a Users directory under app.
I find this structure helps keep the sub-systems together as a coherent "module" and keeps the app directory clean. Additionally,
to reflect the grouping of sub-systems into folders, I group tests into subsystem folders as well. If the application became very large the tests would be further divided into unit, integration, and acceptance sub-folders.
With the advent of the new Controllers directory structure with Laravel 5.3, I have also begun separating Controllers into separate directories based upon their routes; therefore api controllers go in an API directory under Controllers and Auth would go under Auth and so on. 
