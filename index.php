<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Skipe</title>
	<!-- build:css(src) css/app.css -->
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/app.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/image-emoticons.css" />
	<meta name="viewport" content="width=device-width, initial-scale=0.8">
   <link id="favicon" rel="shortcut icon" type="image/png" href="img/favicon.png?v=1" />
	<!-- endbuild -->
	<!-- subrosa skipe client -->
	
		<!-- he is not what he thinks he is, he is what he hides -->

</head>
<body>	
	<div class="preloader">
		<img src="img/spinner.gif"><br />
		Loading Skipe..
	</div>
	<div id="overlay"></div>
	<div id="disconnectedOverlay" style="display: none"><span>OFFLINE <i class="fa fa-spinner fa-spin"></i></span></div>
	<h2 id="permissionGuide"><span class="fa fa-arrow-up"></span> Click 'Allow'.</h2>
	<div class="container" id="app">
		<div id="header">
		<a href="/"><img id="headerLogo" src="/img/talk.png"></a>
		<span style="
    left: 143px;    
    margin-top: 9px;   color:#fff; margin-left: -61px;    position: absolute;    height: 32px;
    font-weight: bold;
    text-shadow: 0px 0px 3px #424242;
"> That's definitely a death flag.</span>
			<div id="headerControls" style="display: none">
				<span id="settingsBtn"><span class="fa fa-cogs"></span></span>
				<span id="logoutBtn"><span class="fa fa-sign-out"></span></span>
			</div>
			<div id="settingsPopover" class="popover popoverDown" style="display: none">
				<div class="popoverCaret caretDown"></div>
				<div class="popoverContent">
					<div class="menuHeader"><strong><span id="settingsHeader"><span class="fa fa-cogs"></span> Settings</span></strong><span id="settingsBack" class="pointer" style="display: none"><span class="fa fa-arrow-up"></span> Back</span></div><hr />
					<span>General Volume</span><br />
					<input id="generalVolumeSlider" type="range" min="0" max="100" step="1" value="70" /><br />
					<span>Ringer Volume</span><br />
					<input id="ringerVolumeSlider" type="range" min="0" max="100" step="1" value="70" /><br />
					<hr />
					<input id="enableNotificationsCheckbox" type="checkbox" checked /> <label for="enableNotificationsCheckbox">Enable notifications</label><br />
					<input id="enableEmoticonsCheckbox" type="checkbox" checked /> <label for="enableEmoticonsCheckbox">Enable <i class="emoji emoji-smile"></i> emoticons</label><br />
					<input id="enableConfirmClosingCheckbox" type="checkbox" checked /> <label for="enableConfirmClosingCheckbox">Confirm closing</label>
				</div>
			</div>
		</div>
		<div id="body">
			<div id="startScreen" style="display: none">
				<div id="startScreenContent">
					<div class="brand">
						<img width="230" src="/img/nerd.jpg">
				
					</div>
					
					<div id="auth">
						<div id="authLeft">
								<img src="img/spinner.gif" id="signInSpinner" style='display: none' />
						
							<form>
							<input id="loginUsername" type="text" class="input-block input-large" placeholder="usr" /><br />
							<input id="loginPassword" type="password" class="input-block input-large loginPassword" placeholder="pwd" /><br />
							<button id="loginButton" class="button input-block button-primary">enter the dungeon</button>			<?php if(isset($_GET['sesame'])) { ?>
   <button class="button" id="createAccountBtn" style="
    width: 100%;
    margin-top: 5px;
">open sesame</button>
	<?php } ?>
							<div id="loginRemember"><input id="loginRememberCheckbox" type="checkbox"><label id="loginRememberLabel" for="loginRememberCheckbox"><small> remember me, please</small></label></div>
							
							<span id="loginErrorMessage" class="errorMessage"></span>
							</form>
						</div>
			
				
					</div>
						<?php if(isset($_GET['sesame'])) { ?>
					<div style="display:none" id="footer">
						Skipe v<span id="versionString"></span> - <span id="versionInfo">checking</span><br />
						<span id="networkString">Network: Not connected</span> <span id="networkControl" style="display: none"><input type="text" id="networkControlInput" class="input-tiny"> <span id="networkControlAccept"><i class="fa fa-check"></i></span></span> <span id="networkControlToggle">&nbsp;<i class="fa fa-ellipsis-h"></i></span>
					</div> 	<?php } ?>
				</div>
					<?php if(isset($_GET['sesame'])) { ?>
				<div id="createAccountContent" style="display: none">
					<div id="createAccountHeader">
						<h2>Create An Account</h2>
					</div>
					<div id="createAccountStep1">
						<form>
						<p>Choose your username. No spaces please.</p>
						<input type="text" class="input-large" id="createAccountStep1Username" placeholder="Username" /> <span id="createAccountStep1Available"></span>
						<p style="display:none;">Your alter ego nick is shown to your contacts. It's not publicly displayed. All characters are allowed.</p>
						<input type="text" class="input-large" id="createAccountStep1Displayname" placeholder="Your alter ego nick" />
						<br /><br /><button class="button disabled" id="createAccountStep1Btn">Next</button>
						</form>
					</div>
					<div id="createAccountStep2" style="display: none">
						<form>
						<p style="display:none">Think of a new, strong password. Don't use the same password on multiple sites.</p>
						<input type="password" class="input-large" id="createAccountStep2Pass1" placeholder="Password" /> <span id="createAccountStep2Strength" class="passwordStrength"></span><br />
						<input type="password" class="input-large" id="createAccountStep2Pass2" placeholder="Confirm password" /> <span id="createAccountStep2Match"></span>
						<p style="display:none"><b>Write down your password somewhere safe</b> - it is never sent to Vault servers, and hence it cannot be reset.</p>
						<button class="button disabled" id="createAccountStep2Btn">Next</button>
						</form>
					</div>
					<div id="createAccountStep3" style="display: none">
						<p style="display:none">Generating your encryption keys - this might take a minute. Move your mouse to add additional entropy.</p>
						<div id="createAccountStep3Gen"></div>
					</div>
					<div id="createAccountStep4" style="display: none">
						<form>
						<p><i class="fa fa-key"></i> Encryption keys generated and protected with your password.</p>

						<input type="hidden" class="input-large" id="createAccountStep4Email" placeholder="Your email (Optional)" /><br />
				
						<p>Type the following numbers:</p>
						<div id="createAccountStep4CaptchaImg">Loading..</div>
						<input type="text" id="createAccountStep4Captcha" />
						<br /><br /><button class="button disabled" id="createAccountStep4Btn">Finish</button><span id="createAccountStep4Registering" style="display: none"><img src='img/spinner.gif'> Registering..</span><span id="createAccountStep4Text"></span>
						</form>
					</div>
					<div id="createAccountStep5" style="display: none">
						<h2>Hi <span id="createAccountStep5Name"></span>!<br><span style="text-align:justify;font-size: 16px;"> "Sometimes, the biggest secrets you can only tell a stranger." ― Michelle Hodkin</span> </h2>
						<p><strong>Hints</strong>
						<ul><li>Your username is <strong><span id="createAccountStep5Username"></span></strong>. Give people this username to find you.</li>
						<li>Your password isn't sent to Skipe's servers. It's not possible for us to recover it, so write it down on paper.</li>
						<li>All communications on Skipe are encrypted <strong>end to end</strong>. Skipe or any third party cannot read them. However, your computer needs to be secure.</li>
						<li></strong>. Skipe or any third party cannot read them. However, your computer needs to be secure.</li></ul>
						Enjoy Skipe, Fuck $kype and have a good time! HAOC</p>
						<br /><button class="button button-primary" id="createAccountStep5Btn">OK</button>
					</div>
					<div id="createAccountFooter">
						
						<span id="createAccountFooterError"></span>
					</div>
				</div>	<?php } ?>
			</div>				
			<div id="loginRememberPopover" class="popover popoverRight" style="display: none">
				<div class="popoverCaret caretRight"></div>
				<div class="popoverContent">
					<strong class="errorMessage">This saves your encryption key on the computer.</strong><br />
					<small>Only do this if you trust the computer.</small>
				</div>
			</div>		
			<div id="permissionScreen" style="display: none">
				<div id="permissionScreenContent">
					<h2>Permissions</h2>
					<hr />
					<div class="pull-left">
						<i class="fa fa-comment largefa"></i><br /><br />
					</div>
					<div class="pull-left permissionHelpBlurb">
						<p><button class="pull-right notificationPermPrompt">Prompt</button><strong>Notifications</strong><br />This is used to notify you of new messages, calls, and when people come online.</p>
						<p>Please click 'Prompt' and then <span class="permissionsWebkit hide">'Allow'</span><span class="permissionsMozilla hide">More arrow -> 'Always Show Notifications'</span>.</p>
					</div>
				</div>
			</div>
			<div id="mainScreen" style="display: none">
				<div id="mainSidebar" class="noSelect">
					<div class="sidebarSearch">
						<input id="sidebarSearchInput" type="text" placeholder="Search / add">
					</div>	
					<div class="sidebarListItem" data-item="me" data-trigger="me">
						<span class="fa fa-pencil editIcon" id="editProfileIcon"></span>
						<img src="img/noavatar.png" class="listItemIcon" />
						<span class="listItemTitle"><span id="meUsername"></span></span><br />
						<span class="listItemSubtitle"></span>
					</div>
					<div id="editProfilePopover" class="popover popoverRight" style="display: none">
					<div class="popoverCaret caretRight"></div>
						<div class="popoverContent">
							<div class="menuHeader"><strong><span id="editProfileHeader"><span class="fa fa-pencil"></span> Edit Profile</span></strong><span id="editProfileBack" class="pointer" style="display: none"><span class="fa fa-arrow-left"></span> Back</span></div><hr />
							<div id="editProfileMain">
								<select id="myStatusSelect"><option value="1">Online</option><option value="2">Busy</option><option value="3">Away</option><option value="4">Invisible</option></select><br /><br />
								<span>Username</span><br />
								<strong id="editProfileUsernameText"></strong><br /><br />
								<span>Status message</span> <a id="editProfileDisplayNameLink">(Edit)</a><br />
								<strong id="editProfileDisplayNameText"></strong><br />
								<br /> | <a id="editProfileAvatarLink">Avatar</a><br> | <a id="editProfilePasswordLink">Password</a><br> | <a id="editProfileBgColorLink">Color</a>   
							</div>
							<div id="editProfileDisplayName" style="display: none">
								<span>New status message</span><br /><br />
								<input type="text" id="editProfileDisplayNameInput" /> <button id="editProfileDisplayNameSave">Save</button><br /><br />
								<span>This is shown to your contacts.</span>
							</div>
							<div id="editProfileBgColor" style="display: none">
								<span>Pick a color message color</span><br /><br />
								<div id="editProfileBgColorPicks"></div><br />
								<small>Other people will only see your new background color after a restart.</small>
							</div>
							<div id="editProfilePassword" style="display: none">
								<span>Change password</span><br /><br />
								<input type="password" id="editProfileOldPass" placeholder="Old password"><br />
								<input type="password" id="editProfileNewPass1" placeholder="New password"> <span id="editProfilePassStrength" class="passwordStrength"></span> <br />
								<input type="password" id="editProfileNewPass2" placeholder="Repeat password"><br />
								<small id="editProfilePassSuccess" class="hide">Password updated.</small><small id="editProfilePassWeak" class="errorMessage hide">New password is too weak.</small><small id="editProfilePassMismatch" class="errorMessage hide">New passwords don't match</small><small id="editProfilePassOldFail" class="errorMessage hide">Old password is incorrect.</small><br />
								<button id="editProfilePasswordSave">Change</button><br /><br />
								<small>Don't use the same password on multiple sites.</small>
							</div>
							<div id="editProfileAvatar" style="display: none">
								<strong>Upload new avatar</strong><br />
								<input class="avatarFile" type="file" data-target="self"/>
								<span style="display: none" class="uploadAvatarProgress" data-target="self">Uploading (0%)</span><br />
								<small>Your avatar is only shown to your contacts.</small>
							</div>
						</div>
					</div>
					<div id="sidebarList">
						<div class="sidebarListItem" data-item="home" data-trigger="home">
							<span class="fa fa-th listItemIcon"></span>
							<span class="listItemTitle">Home</span><br />
							<span class="listItemSubtitle"></span>
						</div>
						<div class="sidebarListItem" data-item="searchElement" data-trigger="searchElement" style="display:none">
							<span class="fa fa-plus listItemIcon"></span>
							<span class="listItemTitle">Search Element</span><br />
							<span class="listItemSubtitle">Message this user or add them to contacts</span>
						</div>
						<div class="sidebarListItem" data-item="meta" data-trigger="meta" style="display: none">
							<span class="fa fa-plus listItemIcon"></span>
							<span class="listItemTitle">New conversation</span><br />
							<span class="listItemSubtitle"></span>
						</div>
						<div class="sidebarListItem" data-item="gedit" data-trigger="gedit" style="display: none">
							<span class="fa fa-plus listItemIcon"></span>
							<span class="listItemTitle">Edit group</span><br />
							<span class="listItemSubtitle"></span>
						</div>
					</div>
				</div>
				<div id="mainLeftDivider"></div>
				<div id="mainContent">
					<div class="contentTab tab-home" style="display:none">
						<div id="quickstart">
							<h3>Get started</h3>
							<img id="qs1m" src="img/quickstart1.jpg" />
							<span id="qst">Add a user</span><br />
							<span id="qsh">Type their username in the <span id="quickstartSearchTip">Search box</span>.<br /><br />Invite someone to Skipe:<br /><input type="text" id="quickstartLink" value="http://is.gd/EMmIDs" readonly></span><br /><br />
						</div>
						<div style="hidden" id="homeNews" class="homeUnit">
							Skipe Updates
							<hr />
							<div id="homeNewsContent">No news for the moment.</div>
						</div>

						<div id="homeInfo" class="homeUnit">
							Info
							<hr />
							<span id="infoSupportCalls" style="display: none"><i class="fa fa-check"></i> Your browser supports voice and video calls.<br /><a id="testUserMedia">Test my <i class="fa fa-microphone"></i> microphone and <i class="fa fa-video-camera"></i> camera</a></span>
							<span id="infoOutdatedSupportCalls" style="display:none"><i class="fa fa-warning"></i> There are known issues with voice and video calls for your browser version, which is outdated. Please update your browser.</span>
							<span id="infoNotSupportCalls" style="display:none"><i class="fa fa-warning"></i> Your browser doesn't support voice and video calls. They are supported in Mozilla Firefox and Google Chrome.</span>
							<div id="mediaTest" style="display: none">
								<span class="close"></span>
								<video id="mediaTestVideo"></video>
								<div id="mediaTestAudio"><i class="fa fa-microphone"></i><div id="mediaTestAudioBar"><div class="filling"></div></div></div>
								<p id="mediaTestHelpText">Use the browser interface to change the webcam or microphone device.</p>
							</div>
							<br /><br />
							<span id="infoHostedWarning" style="display: none"><small><i class="fa fa-globe"></i> WARNING! You're not using the Skipe server. Someone may intercept your communications!</small><br /><br /></span>
							<a id="aboutSkipe">About Skipe</a><br /><br />
					<span>HAOC</span>
						</div>
					</div>
					<div class="contentTab tab-conv" style="display:none">
						<div id="convHeader">
							<img src="img/noavatar.png" id="convPicture" data-status="-1" />
							<div id="convTitle"><div id="convDisplayName"></div><div id="convButtons">
								<button id="addContactButton">Send<span class="hide-tablet"> contact</span> request</button>
								<button id="acceptContactButton" class="acceptContactButton button-success"><i class="fa fa-check"></i> Accept<span class="hide-tablet"> contact request</span></button>
								<button id="addContactFakeButton" class=" disabled">Request sent</button>
								<div class="addContactPopover popover" style="display:none">
									<div class="popoverCaret"></div>
									<div class="popoverTitle">Enter your message</div>
									<div class="popoverContent">
										<textarea class="requestTextarea"></textarea>
										<p class="hintMessage"><small>You can send text messages without adding contacts</small></p>
										<button class="sendRequestBtn input-block button-primary">Send request</button>
									</div>
								</div>
								<button id="unblockButton">Unblock</button>
								<button id="voiceButton"><i class="fa fa-phone"></i> <span class="hide-tablet">Voice</span></button>
								<button id="videoButton"><i class="fa fa-video-camera"></i> <span class="hide-tablet">Video</span></button>
								<button id="inviteButton"><i class="fa fa-plus"></i> <span class="hide-tablet">Invite</span></button>
								<button id="moreButton"><i class="fa fa-ellipsis-v"></i> <span class="hide-tablet">More</span></button>
								<div class="convMorePopover contextMenuPopover popover" style="display:none">
									<div class="popoverCaret"></div>
									<div class="popoverContent">
										<ul class="contextMenu">
											<li id="removeFromContacts">Remove from contacts</li>
											<li id="removeFromList">Remove from list</li>
											<li id="removeFromListRoom">Leave room</li>
											<li id="newGroupChat">New group chat</li>
											<li id="editGroupChat">Edit group info</li>
											<li id="pinToList">Pin to list</li>
											<li id="unpinFromList">Unpin from list</li>
											<li id="blockUser">Block user</li>
											<li id="clearHistory">Clear history</li>
										</ul>
									</div>
								</div>
							</div></div>
							<div id="convSubtitle"><div id="convSubtitleStatusMessage" style="position: relative; bottom: 5px; font-size: 12px; /* display: none; */"></div><div id="convSubtitleStatus"></div><div id="convSubtitleUsers"><i class="fa fa-users"></i> <div id="convSubtitleUsersList"></div> <a id="convSubtitleUsersMore"></a></div></div>
							<div id="usersMorePopover" class="popover" style="display: none">
								<div class="popoverCaret"></div>
								<div class="popoverContent">
									<div id="usersMorePopoverLoading">
										<img src="img/spinner.gif">
										<br />
										Loading
									</div>
									<div id="usersMorePopoverContent"></div>
								</div>
							</div>
						</div>
						<div id="convActive" style="display: none">
							<div id="voiceActive">
								<div class="activeContent pull-left">
									<span id="voiceIcon" class="fa fa-phone"></span>
									<span id="videoIcon" class="fa fa-video-camera"></span>
									<span id="voiceIncomingText">Incoming call</span>
									<span id="voiceGroupText">Group call</span>
									<span id="voiceRingingText" class="semiblink">Ringing..</span>
									<span id="voiceIncallText" class="semiblink">In call</span>
								</div>
								<span id="callDuration"></span>
								<div id="voiceUsers" class="noSelect"><span class="fa fa-users"></span> <span id="voiceUsersCount"></span></div>
								<div id="voiceAccept" class="semiblink noSelect"><span id="voiceAcceptAccept">Accept</span><span id="voiceAcceptJoin">Join</span></div>
								<div id="voiceDrop" class="noSelect"><span id="voiceDropDrop">Drop</span><span id="voiceDropCancel">Cancel</span></div>
								<div id="voiceControls" class="noSelect">
									<div id="voiceMute"><span id="voiceMuteOn"><span class="fa fa-microphone-slash"></span></span><span id="voiceMuteOff"><span class="fa fa-microphone"></span></span></div>
									<div id="videoMute"><span id="videoMuteOn"><span class="fa fa-eye-slash"></span></span><span id="videoMuteOff"><span class="fa fa-eye"></span></span></div>
								</div>
							</div>
						</div>
						<div id="convBody">
							<div id="convText"></div>
						</div>
						<div id="convFooter">
							<div id="convFooterLeft">
								<div id="encInfo"><span id="encInfoEncrypted">Encrypted</span><span id="encInfoReady">Ready</span> <span class="fa fa-info-circle"></span></div>
								<div id="encInfoPopover" class="popover popoverBottom" style="display: none">
									<div class="popoverContent">
										<div id="encPopoverEncrypted">
											<strong><span class="fa fa-lock"></span> Encrypted</strong><br />
											<span>Your communication is <a id="securityInfoTrigger">end to end encrypted</a> with AES.</span><br /><br />
											<span>Key: <span id="encKey"></span></span>
										</div>
										<div id="encPopoverReady">
											<strong><span class="fa fa-circle-o"></span> Ready</strong><br />
											<span>Skipe is ready to encrypt. Just send them a message.</span>
										</div>
									</div>
									<div class="popoverCaret caretBottom"></div>
								</div>
							</div>
							<div id="convFooterMiddle">
								<span id="convTyping"></span><br />
								<textarea id="convInput" maxlength="1000"></textarea>
								<span id="convEmoticon" class="fa fa-smile-o"></span>
								<div id="convEmoticonPopover" class="popover popoverBottom" style="display: none">
									<div class="popoverContent">
										<div id="emojiPicker"></div>
										<small><a href="http://www.emoji-cheat-sheet.com/" target="_blank">View all Emoticons</a></small>
									</div>
									<div class="popoverCaret caretBottom"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="contentTab tab-meta" style="display: none">
						<div id="roomInviteMenu">
							<h2>Group chat</h2>
							<hr />
							<div id="roomInviteCreate">Group chat name: <input type="text" id="roomCreateName" maxlength="20"/><br /><br />
							<small>Select who to invite to a new group chat.</small></div>
							<div id="roomInviteAdd"><p>Select who to invite to <span id="roomAddName"></span></p></div>
							<div id="roomInviteUserlist"></div>
							<hr />
							<button class="button button-primary" id="roomInviteConfirm"><span id="roomCreateBtnText">Create Group Chat</span><span id="roomAddBtnText">Invite</span></button> <button class="button" id="roomInviteCancel">Cancel</button>
						</div>
					</div>
					<div class="contentTab tab-gedit" style="display: none">
						<div id="roomEditMenu">
							<h2>Edit group chat</h2>
							<hr />
							<div>Room name</div>
							<input type="text" id="roomEditName" maxlength="20" /><br /><br />
							<div>New avatar <small>(takes immediate effect)</small></div>
							<input class="avatarFile" type="file"/>
							<span style="display: none" class="uploadAvatarProgress">Uploading (0%)</span><br /><br />
							<button class="button button-primary" id="roomEditConfirm">Save changes</button> <button class="button" id="roomEditCancel">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="modal" class="modal"><span id="modalClose" class="close"></span>
			<div data-ref="kicked">
				<h2>Kicked</h2>
				<p><a class="userLink dottedLink" id="kickerUsername"></a> kicked you from the room <strong id="kickedFromName"></strong>. You can rejoin if someone invites you again.</p>
			</div>
			<div data-ref="noInvite">
				<h2>No invite</h2>
				<p>You don't have an invite to this room. You may have been kicked. You can rejoin when someone invites you again.</p>
			</div>
			<div data-ref="userRank">
				<h2>Set rank</h2>
				<p>Set the rank for user <a class="userLink dottedLink" id="userRankUsername"></a> to <select id="userRankSelect"><option value="0">Normal user</option><option value="2">Moderator</option><option value="4">Admin</option><option value="9">Superadmin</option></select> <button id="userRankApply">Apply</button></p>
				<p class="userRankDesc" data-rank="0" style="display: block">Normal users have no special privileges.</p>
				<p class="userRankDesc" data-rank="2">Moderators can <strong>kick users</strong>.</p>
				<p class="userRankDesc" data-rank="4">Admins can <strong>kick users</strong>, <strong>edit group info</strong>, and <strong>make users moderators.</strong></p>
				<p class="userRankDesc" data-rank="9">Superadmins can <strong>kick users</strong>, <strong>edit group info</strong>, and <strong>make users</strong> up to <strong>superadmins</strong>.</p>
				<p class="errorMessage"><span id="userRankNoPermU" style="display: none">You don't have permission to edit the rank of this user.</span> <span id="userRankNoPermR" style="display: none">You don't have permission to set the user to this rank.</span></p>
			</div>
			<div data-ref="noPermission">
				<h2>No permission</h2>
				<p>You don't have permission to do that.</p>
			</div>
			<div data-ref="notOnline">
				<h2>Not online</h2>
				<p>The user isn't currently online - you can't call.</p>
			</div>
			<div data-ref="p2pWarning">
				<h2>Direct connection</h2>
				<p>When you call someone, a direct encrypted connection is established between the participants. It is possible for other participants to find your IP address.<br /><br /><small>This will not be shown again.</small></p>
				<button id="p2pWarningContinue" class="button-primary">Continue call</button> <button id="p2pWarningCancel">Cancel</button>
			</div>
			<div data-ref="historyCleared">
				<h2>History cleared</h2>
				<p>The history has been cleared.</p>
			</div>
			<div data-ref="logout">
				<h2>Logged out</h2>
				<p>You have logged out.</p>
			</div>
			<div data-ref="avatarUploadFailed">
				<h2>Avatar upload failed</h2>
				<p>Failed to upload avatar. Please make sure you're uploading an image.</p>
			</div>
			<div data-ref="blockedUser">
				<h2>Blocked user</h2>
				<p>You've blocked this user. You won't get any more messages from them. To unblock, add them to your list again and click 'Unblock'.</p>
			</div>
			<div data-ref="securityInfo">
				<h2>Encryption info</h2>
				<p>Your communication is encrypted using AES, with 256-bit used for text messages and 128-bit used for voice communications. The encryption key was exchanged using 2048 bit RSA keypairs.</p>
				<p>All encryption is performed locally in your browser - this is called 'end to end encryption'. Skipe <strong>never</strong> has access to your encryption keys. It is <strong>not possible</strong> for Skipe to read your messages or listen to your calls.</p>
				<p>The key lengths are considered secure until ~2030. However, cryptographic breakthroughs may occur.</p>
			
			</div>
			<div data-ref="displayNameNotAllowed">
				<h2>Not allowed</h2>
				<p>This isn't allowed as a display name.</p>
			</div>
			<div data-ref="verifyKey">
				<h2>Verify key</h2>
				<p>To verify there is no 'man in the middle' attack being performed, you and the other party should see the same hash.<br /><br /><small>This is the SHA256 hash of both public keys concatenated in PEM format.</small></p>
				<span id="verifyKeyHash"><span id='main'></span><span id='tiny'></span></span>
			</div>
			
			<div data-ref="verifyFingerprintFail">
				<h2>Possible interception detected</h2>
				<p>Skipe has detected possible interception of your call. This may mean a party with capability to modify your network requests is intercepting your call, or it may be bug in Skipe creating a false positive. Try again in a while, prehaps on a different network.</p>
			</div>
			<div data-ref="callsNotSupported">
				<p>Your browser does not support voice or video calls. Please use Mozilla Firefox or Google Chrome.</p>
			</div>
			<div data-ref="systemTimeInaccurate">
				<p>Your computer's time/date is significantly inaccurate. Skipe requires your computer's time to be accurate.</p> <p><strong>Other users will not receive <i>any</i> of your messages.</strong> Please correct your system time.</p>
			</div>
			<div data-ref="errorReporter">
				<div id="errorReporterAsk" style="display: none">
					<p>Skipe encountered an error. Skipe developers can review and fix the issue if you send the error report. <small>(Please send it!)</small></p>
					<pre id="errorReportTrace"></pre>
					<button id="errorReporterReport" class="button-primary">Send this report</button> <button id="errorReporterIgnore">Don't send</button>
				</div>
				<div id="errorReporterThanks" style="display: none">
					<p>Report sent. <strong>Thank you!</strong> If anything is broken, try refreshing.</p>
				</div>
			</div>
			<div data-ref="about">
				<h2>About Skipe</h2>
				<p><small>Skipe v1.00</small></p>
				<p>Crafted with &hearts; by ixro.</p>
				<p>Special thanks to G and P for all the support and help :)</p>
			</div>
		</div>
	</div>
	<div class="hide" id="htmlToText"></div>
	
	<!-- build:js(src) vendor.min.js -->
	<script src="vendor/engineio.js"></script>
	<script src="vendor/forge.js"></script>
	<script src="vendor/scrypt-async.js"></script>
	<script src="vendor/jquery.js"></script>
	<!-- endbuild -->
	
	<!-- build:js(src) app.min.js -->
	<script src="js/app-call.js"></script>
	<script src="js/app-core-crypto.js"></script>
	<script src="js/app-core.js"></script>
	<script src="js/app-emoticons.js"></script>
	<script src="js/app-passwordstrength.js"></script>
	<script src="js/app-view-convmodel.js"></script>
	<script src="js/app-view-uifuncs.js"></script>
	<script src="js/app-view-uisetters.js"></script>
	<script src="js/app-view.js"></script>
	<script src="js/app-webrtc.js"></script>
	<!-- endbuild -->
	
	<!-- Sound -->
	<audio src="sound/newMessage.ogg" id="soundNewMessage" preload="auto"></audio>
	<audio src="sound/ringing.ogg" id="soundRinging" preload="auto"></audio>
</body>
</html>
