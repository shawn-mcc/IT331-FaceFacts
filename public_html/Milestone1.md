<table><tr><td> <em>Assignment: </em> IT202 Milestone1 Deliverable</td></tr>
<tr><td> <em>Student: </em> Shawn McCausland(spm57)</td></tr>
<tr><td> <em>Generated: </em> 7/6/2022 1:58:19 AM</td></tr>
<tr><td> <em>Grading Link: </em> <a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-451-M22/it202-milestone1-deliverable/grade/spm57" target="_blank">Grading</a></td></tr></table>
<table><tr><td> <em>Instructions: </em> <ol><li>Checkout Milestone1 branch</li><li>Create a milestone1.md file in your Project folder</li><li>Git add/commit/push this empty file to Milestone1 (you'll need the link later)</li><li>Fill in the deliverable items<ol><li>For each feature, add a direct link (or links) to the expected file the implements the feature from Heroku Prod (I.e,&nbsp;<a href="https://mt85-prod.herokuapp.com/Project/register.php">https://mt85-prod.herokuapp.com/Project/register.php</a>)</li></ol></li><li>Ensure your images display correctly in the sample markdown at the bottom</li><li>Save the submission items</li><li>Copy/paste the markdown from the "Copy markdown to clipboard link" or via the download button</li><li>Paste the code into the milestone1.md file or overwrite the file</li><li>Git add/commit/push the md file to Milestone1</li><li>Double check the images load when viewing the markdown file (points will be lost for invalid/non-loading images)</li><li>Make a pull request from Milestone1 to dev and merge it (resolve any conflicts)<ol><li>Make sure everything looks ok on heroku dev</li></ol></li><li>Make a pull request from dev to prod (resolve any conflicts)<ol><li>Make sure everything looks ok on heroku prod</li></ol></li><li>Submit the direct link from github prod branch to the milestone1.md file (no other links will be accepted and will result in 0)</li></ol></td></tr></table>
<table><tr><td> <em>Deliverable 1: </em> Feature: User will be able to register a new account </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="http://via.placeholder.com/400x120/009955/fff?text=Complete"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add one or more screenshots of the application showing the form and validation errors per the feature requirements</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177470521-1677efcb-8a8a-4336-bba6-5d1df0541edb.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>Email<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177470522-39401854-b395-47b8-9322-51ac9bf42af6.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>Password<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177470523-4e35f17b-b0af-4b7a-900d-b55ab8cfc57a.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>Confirm<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177470606-4b4967f6-7eff-438d-b007-c87afc073a27.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>Email Registered<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177470526-2c45ba90-fdf6-4ac4-a1c5-ce640b435d9f.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>Username Taken<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177470527-6bd717d0-e092-40d5-a2bf-aee755efee07.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>Valid data<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot of the Users table with data in it</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177470989-d183645a-7eaa-4241-95a4-f8986ae46b01.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>New user created in db<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="//github.com/XxCrashOverridexX/IT202-451/pull/9">github.com/XxCrashOverridexX/IT202-451/pull/9</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Explain briefly how the process/code works</td></tr>
<tr><td> <em>Response:</em> <p>Prepares the user data from to form and load them into placeholders, then<br>tries to update the data in the database with the new information. We<br>catch any errors from trying to update and translate them to human-readable for<br>users.&nbsp;<br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 2: </em> Feature: User will be able to login to their account </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="http://via.placeholder.com/400x120/009955/fff?text=Complete"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add one or more screenshots of the application showing the form and validation errors per the feature requirements</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177471709-8f517a13-18a1-401d-807b-eff41e1b40ba.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>password mismatch<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177471716-aba5c24d-ea01-4e21-a118-f7500e068a70.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>No user<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot of successful login</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177471993-39bc2f3e-dabc-4e75-9f5c-e69a70bbefb0.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>Logged in<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="//github.com/XxCrashOverridexX/IT202-451/pull/9">github.com/XxCrashOverridexX/IT202-451/pull/9</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Explain briefly how the process/code works</td></tr>
<tr><td> <em>Response:</em> <p>Does validation on the client side to make sure form is at least<br>partially filled out correctly, then tries to find a matching key pair in<br>the db<br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 3: </em> Feat: Users will be able to logout </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="http://via.placeholder.com/400x120/009955/fff?text=Complete"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot showing the successful logout message</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177472221-ab9b402d-70cc-4274-bf55-defdc5f46a73.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>Logout<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot showing the logged out user can't access a login-protected page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177472283-2d7674a3-4920-4e75-a144-abf73fe0bfdd.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>Cannot go to protected page<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="//github.com/XxCrashOverridexX/IT202-451/pull/9">github.com/XxCrashOverridexX/IT202-451/pull/9</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Explain briefly how the process/code works</td></tr>
<tr><td> <em>Response:</em> <p>by destroying the session, we can prevent users from being able to access<br>protected pages without logging in<br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 4: </em> Feature: Basic Security Rules Implemented / Basic Roles Implemented </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="http://via.placeholder.com/400x120/009955/fff?text=Complete"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot showing the logged out user can't access a login-protected page (may be the same as similar request)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177472283-2d7674a3-4920-4e75-a144-abf73fe0bfdd.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>Can&#39;t get to page w/o login<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot showing a user without an appropriate role can't access the role-protected page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177472679-04284fe4-5a93-4970-bdf9-43836fd68dcd.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>Permission denied<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a screenshot of the Roles table with valid data</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177472809-4bb717d9-0499-4ded-afd3-8dec0f4b6379.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>Roles table<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add a screenshot of the UserRoles table with valid data</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177472928-a1b987bc-80c5-46b7-bd73-075c42ef88f0.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>UserRoles table<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 5: </em> Add the related pull request(s) for these features</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="//github.com/XxCrashOverridexX/IT202-451/pull/26">github.com/XxCrashOverridexX/IT202-451/pull/26</a> </td></tr>
<tr><td> <em>Sub-Task 6: </em> Explain briefly how the process/code works for login-protected pages</td></tr>
<tr><td> <em>Response:</em> <p>We validate with our is_logged_in function in our user helpers file<br></p><br></td></tr>
<tr><td> <em>Sub-Task 7: </em> Explain briefly how the process/code works for role-protected pages</td></tr>
<tr><td> <em>Response:</em> <p>We validate with our has_role function in our user helpers file<br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 5: </em> Feature: Site should have basic styles/theme applied; everything should be styled </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="http://via.placeholder.com/400x120/009955/fff?text=Complete"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots to show examples of your site's styles/theme</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177473364-fe91f21b-006f-4617-af5c-17ac6d8dddde.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Basic Style<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/XxCrashOverridexX/IT202-451/pull/30">https://github.com/XxCrashOverridexX/IT202-451/pull/30</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Briefly explain your CSS at a high level</td></tr>
<tr><td> <em>Response:</em> <p>I tried to make everything centered and nice. The nav bar is sticky<br>to the top of the page and changes colors on hover. Forms have<br>a general background and the submit button also changes on hover. Admin pages<br>(create_roles,assign_roles,list_roles) in the nav bar changed to general &quot;admin tools&quot; that has a<br>dropdown into those three pages.<br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 6: </em> Feature: Any output messages/errors should be "user friendly" </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="http://via.placeholder.com/400x120/009955/fff?text=Complete"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots of some examples of errors/messages</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177474195-e46e29db-961e-4359-842e-16802dde3e95.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>Error if trying to create a duplicate role<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a related pull request</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/XxCrashOverridexX/IT202-451/pull/28">https://github.com/XxCrashOverridexX/IT202-451/pull/28</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Briefly explain how you made messages user friendly</td></tr>
<tr><td> <em>Response:</em> <p>Checked exceptions to see if it was a known error, then flash a<br>nicer message to users, or general &quot;something went wrong&quot; if it wasn&#39;t an<br>expected error<br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 7: </em> Feature: Users will be able to see their profile </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="http://via.placeholder.com/400x120/009955/fff?text=Complete"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots of the User Profile page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177474519-3e2503c6-481b-47a9-ac71-18c1c3621196.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>Profile Page<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/XxCrashOverridexX/IT202-451/pull/24">https://github.com/XxCrashOverridexX/IT202-451/pull/24</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Explain briefly how the process/code works (view only)</td></tr>
<tr><td> <em>Response:</em> <p>using se in php to preload form values<br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 8: </em> Feature: User will be able to edit their profile </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="http://via.placeholder.com/400x120/009955/fff?text=Complete"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots of the User Profile page validation messages and success messages</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177477930-39a6870d-713a-4a6d-b610-38bd2c4e5352.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>username unavailable<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177477931-65af8531-6c6b-4f14-aa95-baca7784be16.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>password mismatch<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add before and after screenshots of the Users table when a user edits their profile</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177478465-eac97753-ed09-455a-a638-0b7aa446d82c.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>before<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177478466-48702bc5-081c-4abd-b74b-357c1e94a05f.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>after<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/XxCrashOverridexX/IT202-451/pull/24">https://github.com/XxCrashOverridexX/IT202-451/pull/24</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Explain briefly how the process/code works (edit only)</td></tr>
<tr><td> <em>Response:</em> <p>search for the user using data from session, then overwrite table entries<br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 9: </em> Issues and Project Board </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="http://via.placeholder.com/400x120/009955/fff?text=Complete"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots showing which issues are done/closed (project board) Incomplete Issues should not be closed</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/10052698/177478917-92999b2a-a5d4-4390-9e97-6f149130290f.PNG"/></td></tr>
<tr><td> <em>Caption:</em> <p>Project board<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Include a direct link to your Project Board</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/XxCrashOverridexX/IT202-451/projects/1">https://github.com/XxCrashOverridexX/IT202-451/projects/1</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Prod Application Link to Login Page</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://spm57-prod.herokuapp.com/Project/login.php">https://spm57-prod.herokuapp.com/Project/login.php</a> </td></tr>
</table></td></tr>
<table><tr><td><em>Grading Link: </em><a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-451-M22/it202-milestone1-deliverable/grade/spm57" target="_blank">Grading</a></td></tr></table>