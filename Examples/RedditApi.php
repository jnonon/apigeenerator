<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 *
 */

namespace ADD\A\PSR0\NamespaceReference;
/**
 * FIXME: Add Description
 * @author Author <author@github.com>
 *
 */
class RedditApi
{
    /**
     * Api base Url
     * @var string
     */
     protected $baseUrl = "http://www.reddit.com/";


    /**
     * Constructor
     *
     */
    public function __construct()
    {


    }

    /**
     * Returns information about a link given its fullname.
     * http://github.com/reddit/reddit/wiki/API
     *
     * @param string $fullname A base-36 id of the form /t[0-9]+_[a-z0-9]+/ (e.g. t3_6nw57) that reddit associates with every Thing. In the example, the type prefix t3_ specifies that the fullname is for a Link, and the id 6nw57 specifies the Link&#039;s id36. (Note: the numbers according to id type are not constant, and may vary between reddit installations.)
     * @param string $format Format of the data being returned. Accepted values: json (JSON), rss (RSS feed), xml (RSS feed)
     */
    public function getLinkByFullname($fullname, $format)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Returns information about a link, with comments, given its id36.
     * http://github.com/reddit/reddit/wiki/API
     *
     * @param string $id36 The second part of the fullname, a base-36 id of the form /t[0-9]+_[a-z0-9]+/ (e.g. t3_6nw57) that reddit associates with every Thing. In the example, the type prefix t3_ specifies that the fullname is for a Link, and the id 6nw57 specifies the Link&#039;s id36. (Note: the numbers according to id type are not constant, and may vary between reddit installations.)
     * @param string $format Format of the data being returned. Accepted values: json (JSON), rss (RSS feed), xml (RSS feed)
     */
    public function getLinkByFullnameComments($id36, $format)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Returns information about a URL's submissions.
     * http://github.com/reddit/reddit/wiki/API%3A-info.json
     *
     * @param anyURI $url Format: a URL. Specify either this or id.
     * @param string $id Format: a link ID. Specify either this or url.
     * @param integer $limit Presumably, limits the number of links returned. Format: a number.
     * @param string $format Format of the data being returned. Accepted values: json (JSON), xml (XML)
     */
    public function getGetInfo($url, $id, $limit, $format)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Returns expanded link content.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $linkId The link to expand.
     */
    public function getPostExpando($linkId)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Logs a user in. Returns a SetCookie line in the HTTP header, identifying the new session.
     * https://github.com/reddit/reddit/wiki/API%3A-login
     *
     * @param string $user The username to authenticate as. This is redundant, but required.
     * @param string $passwd The plain-text password for the account.
     * @param string $apiType Must be &quot;json&quot; for the style of auth used in this documentation.
     * @param string $username The username to log in as.
     */
    public function getLogin($user, $passwd, $apiType, $username)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Retrieves information from a user's "about" page, including karma totals.
     * http://github.com/reddit/reddit/wiki/API
     *
     * @param string $username The name of the user whose &quot;about&quot; page to retrieve.
     */
    public function getUserAbout($username)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Returns information about the logged-in user.
     * http://github.com/reddit/reddit/wiki/API%3A-me.json
     *
     */
    public function getGetMe()
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Returns information about the subreddits the currently logged-in user subscribes to.
     * http://github.com/reddit/reddit/wiki/API%3A-mine.json
     *
     * @param string $format Format of the data being returned. Accepted values: json (JSON), xml (XML)
     */
    public function getGetMine($format)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Registers a new user.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $user The username to register.
     * @param string $email The user&#039;s email address.
     * @param string $passwd The user&#039;s password.
     * @param string $passwd2 The user&#039;s password, again. Has to be the same as &quot;passwd&quot;.
     * @param string $dest Destination?
     * @param boolean $rem Format: boolean
     * @param boolean $reason Possible accepted values: redirect, subscribe
     */
    public function getPostRegister($user, $email, $passwd, $passwd2, $dest, $rem, $reason)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Permanently deletes the logged-in user.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $areyousure1 Verification. All three parameters must be &quot;yes&quot; to delete user successfully. Accepted values: yes, no
     * @param string $areyousure2 Verification. All three parameters must be &quot;yes&quot; to delete user successfully. Accepted values: yes, no
     */
    public function getPostDeleteUser($areyousure1, $areyousure2)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Handles self-removal as moderator from a subreddit as rendered in the subreddit sidebox on any of that subreddit's pages.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $id ID?
     */
    public function getPostLeavemoderator($id)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Handles self-removal as contributor from a subreddit as rendered in the subreddit sidebox on any of that subreddit's pages.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $id ID?
     */
    public function getPostLeavecontributor($id)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Sends a forgot-password message to an account holder.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $name A username with a valid email address.
     */
    public function getPostPassword($name)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Resets a user's password.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $reset Cache key?
     * @param string $passwd The new password.
     * @param string $passwd2 The new password, again. Must be the same as &quot;passwd&quot;.
     */
    public function getPostResetpassword($reset, $passwd, $passwd2)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Submits a link/story. For submitting to work, the reddit_session cookie needs to be present in the request, or the answer to a CAPTCHA must be supplied.
     * http://github.com/reddit/reddit/wiki/API
     *
     * @param string $url The link to submit, if the &quot;kind&quot; parameter is &quot;link&quot;. Required if the story is a regular post.
     * @param string $text The text to submit, if the &quot;kind&quot; parameter is &quot;self&quot;. Required if the story is a self post.
     * @param string $kind Accepted values: link, self.
     * @param string $sr The subreddit to submit the link to.
     * @param string $title The text to appear as a link to the new story.
     * @param string $r The subreddit, again. (?)
     */
    public function getSubmit($url, $text, $kind, $sr, $title, $r)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Shares a link/story via email to a friend on the logged-in user's behalf. For sharing to work, the reddit_session cookie needs to be present in the request, or the answer to a CAPTCHA must be supplied.
     * http://github.com/reddit/reddit/wiki/API
     *
     * @param string $parent The thing you want to share. See API docs for more details about things.
     * @param string $shareFrom The name of the person who is sending the message. Maximum 100 characters.
     * @param string $replyto The email address of the person who is sending the message.
     * @param string $shareTo The email address of the recepient of the message.
     * @param string $message The text that precedes the link to the story in the message. Maximum 1000 characters.
     * @param string $renderstyle Presumably, the email format. Known accepted value: html
     */
    public function getShare($parent, $shareFrom, $replyto, $shareTo, $message, $renderstyle)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Casts or rescinds a vote on a story/comment.
     * http://github.com/reddit/reddit/wiki/API%3A-vote
     *
     * @param string $id The fullname of the thing you are voting for.
     * @param string $dir The vote you are going to cast. Use 1 to vote up, 0 to rescind a vote, or -1 to vote down. Note that previous votes are not additive. If the user previously voted 1, voting -1 will change the vote to -1, not 0. Accepted values: -1 (downvote), 0 (neutral-vote), 1 (upvote)
     */
    public function getPostVote($id, $dir)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Returns the title for a story, given its URL.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param anyURL $url The URL to fetch the title of.
     */
    public function getPostFetchTitle($url)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Marks a thing as NSFW.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $id The fullname of the thing to mark.
     */
    public function getPostMarknsfw($id)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Marks a thing as SFW (unmarks as NSFW)
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $id The fullname of the thing to unmark.
     */
    public function getPostUnmarknsfw($id)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Saves a post.
     * https://github.com/reddit/reddit/wiki/API%3A-save
     *
     * @param string $id The fullname of the post to save.
     */
    public function getPostSave($id)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Unsaves a post.
     * https://github.com/reddit/reddit/wiki/API%3A-unsave
     *
     * @param string $id The fullname of the post to unsave.
     */
    public function getPostUnsave($id)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Hides a post.
     * https://github.com/reddit/reddit/wiki/API%3A-hide
     *
     * @param string $id The fullname of the post to hide.
     */
    public function getPostHide($id)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Unhides a post.
     * https://github.com/reddit/reddit/wiki/API%3A-unhide
     *
     * @param string $id The fullname of the post to unhide.
     */
    public function getPostUnhide($id)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Deletes things.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $id The fullname of the thing to delete.
     */
    public function getPostDel($id)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Updates the user text on a thing.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $thingId The fullname of the thing to update.
     * @param string $text The new text.
     */
    public function getPostEditusertext($thingId, $text)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Removes a thing.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $id The thing to remove.
     */
    public function getPostRemove($id)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Approves a thing.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $id The thing to approve.
     */
    public function getPostApprove($id)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Distinguishes a thing.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $id The thing to distinguish.
     * @param string $how Accepted values: yes, no, admin.
     */
    public function getPostDistinguish($id, $how)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Handles message composition under /message/compose
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $to The recepient of the message.
     * @param string $subject The subject of the message.
     * @param string $text The message.
     * @param string $captcha CAPTCHA result.
     */
    public function getPostCompose($to, $subject, $text, $captcha)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Collapses a message.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $id A list of messages to collapse.
     */
    public function getPostCollapseMessage($id)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Collapses a message.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $id A list of messages to uncollapse.
     */
    public function getPostUncollapseMessage($id)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Mark a message as unread.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $id The message to mark as unread.
     */
    public function getPostUnreadMessage($id)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Mark a message as read.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $id The message to mark as read.
     */
    public function getPostReadMessage($id)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Hides a message.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $id The message to hide.
     */
    public function getPostHideMessage($id)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Unhides a message.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $id The message to unhide.
     */
    public function getPostUnhideMessage($id)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Retrieves more messages by parent.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $parentId The message parent.
     */
    public function getPostMoremessages($parentId)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Posts a comment.
     * https://github.com/reddit/reddit/wiki/API%3A-comment
     *
     * @param string $parent The fullname of the thing or comment you are commenting on.
     * @param string $text The markdown content of the comment you are posting.
     */
    public function getPostComment($parent, $text)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Retrieves more comment children.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $linkId The id of the link to get the comments for.
     * @param string $where Comment sorting option.
     * @param string $children Children comment IDs.
     * @param string $pvHex Maximum 40 characters?
     * @param string $id Some kind of ID.
     */
    public function getPostMorechildren($linkId, $where, $children, $pvHex, $id)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Complement to "unfriend": handles friending as well as privilege changes on subreddits.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $name The user to add as a friend.
     * @param string $container Either the current user or the subreddit.
     * @param string $type Accepted values: friend, moderator, contributor, banned
     * @param string $note A &quot;friend note&quot;. Maximum 300 characters.
     */
    public function getPostFriend($name, $container, $type, $note)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Handles removal of a friend (a user-user relation) or removal of a user's privileges from a subreddit (a user-subreddit relation). The user can either be passed in by name (name) or by fullname (id). 'container' will either be the current user or the subreddit.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $name The user&#039;s name.
     * @param string $id The user&#039;s fullname.
     * @param string $container Either the current user or the subreddit.
     * @param string $type Accepted values: friend, moderator, contributor, banned
     */
    public function getPostUnfriend($name, $id, $container, $type)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Attach a note to a friend.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $name The friend to whom to associate the note with.
     * @param string $note A note. Maximum 300 characters.
     */
    public function getPostFriendNote($name, $note)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Handles /prefs/update for updating email address and password.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $curpass The current password of the logged-in user. Required to update any setting.
     * @param string $email A new email.
     * @param string $newpass A new password.
     * @param string $verpass A new password, again. Must be the same as &quot;newpass&quot;.
     * @param boolean $verify Whether or not to send an email verification letter? Format: boolean
     */
    public function getPostUpdate($curpass, $email, $newpass, $verpass, $verify)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Turns on the preference to show comments panel.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     */
    public function getPostTbCommentspanelShow()
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Turns off the preference to show comments panel.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     */
    public function getPostTbCommentspanelHide()
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Creates or updates subreddits.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $sr Subreddit.
     * @param string $name Subreddit name.
     * @param string $title A title for the subreddit. Maximum 100 characters.
     * @param string $headerTitle A title for the subreddit for the header. Maximum 500 characters.
     * @param string $domain Subreddit domain. &quot;Own a domain? Enter it here and then go to your DNS provider and add a CNAME record aliasing your domain to rhs.reddit.com. You will be able to access your reddit through your domain.&quot;
     * @param string $description Subreddit description. Maximum 5120 characters.
     * @param string $lang Subreddit language.
     * @param boolean $over18 Whether or not this is a &quot;mature content&quot; subreddit; viewers must be at least 18 years old.
     * @param boolean $allowTop Whether or not to allow this subreddit to be shown in the &quot;default set&quot;.
     * @param boolean $showMedia Whether or not to show thumbnails images of content.
     * @param string $type Subreddit type. Accepted values: public (anyone can view and submit), private (only approved members can view and submit), restricted (anyone can view, but only approved members can submit)
     * @param string $linkType Subreddit content options. Accepted values: any (any link type is allowed), link (only links to external sites allowed), self (only self posts allowed)
     * @param string $sponsorshipText Sponsorship text. Maximum 500 characters.
     * @param string $sponsorshipName Sponsorship name. Maximum 500 characters.
     * @param string $sponsorshipUrl Sponsorship URL. Maximum 500 characters.
     * @param boolean $cssOnCname Whether or not to show subreddit style while accessing the subreddit through the domain?
     */
    public function getPostSiteAdmin($sr, $name, $title, $headerTitle, $domain, $description, $lang, $over18, $allowTop, $showMedia, $type, $linkType, $sponsorshipText, $sponsorshipName, $sponsorshipUrl, $cssOnCname)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Updates the CSS for a subreddit.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $stylesheetContents The stylesheet.
     * @param string $op Operation. Accepted values: save, preview
     */
    public function getPostSubredditStylesheet($stylesheetContents, $op)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Deletes a subreddit image. Called called upon requested delete on /about/stylesheet. Updates the site's image list, and causes the <li> which wraps the image to be hidden.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $imgName The image to delete.
     */
    public function getPostDeleteSrImg($imgName)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Called when the user request that the header on a subreddit be reset.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $imgName The image to delete.
     */
    public function getPostDeleteSrHeader($imgName)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Completely unnecessary method which exists because safari can be dumb too. On page reload after an image has been posted in safari, the iframe to which the request posted preserves the URL of the POST, and safari attempts to execute a GET against it. The iframe is hidden, so what it returns is completely irrelevant.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     */
    public function getGetUploadSrImg()
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Called on /about/stylesheet when an image needs to be replaced or uploaded, as well as on /about/edit for updating the header. Unlike every other POST in this controller, this method does not get called with Ajax but rather is from the original form POSTing to a hidden iFrame. Unfortunately, this means the response needs to generate an page with a script tag to fire the requisite updates to the parent document, and, more importantly, that we can't use our normal toolkit for passing those responses back. The result of this function is a rendered UploadedImage() object in charge of firing the completedUploadImage() call in JS.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $name The name for the image.
     * @param string $formid Form ID. Maximum 100 characters.
     * @param boolean $header Whether or not this is a header image? Accepted values: 0, 1
     * @param boolean $sponsor Whether or not something is sponsored? Used by admins only. Accepted values: 0, 1
     */
    public function getPostUploadSrImg($name, $formid, $header, $sponsor)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Subscribes or unsubscribes the logged-in user to a subreddit.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $action Accepted values: sub (subscribe), unsub (unsubscribe)
     * @param string $sr The subreddit.
     */
    public function getPostSubscribe($action, $sr)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Searches for subreddits with the given query.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $query The search query. Maximum 50 characters.
     */
    public function getPostSearchRedditNames($query)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Returns the flair assignments of a subreddit.
     * https://github.com/reddit/reddit/wiki/API%3A-flairlist
     *
     * @param string $r The name of the subreddit.
     * @param positiveInteger $limit The maximum number of items to return (up to 1000).
     * @param string $after Return entries starting after this user.
     * @param string $before Return entries starting before this user.
     */
    public function getFlairlist($r, $limit, $after, $before)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Sets or clears a user's flair in a subreddit.
     * https://github.com/reddit/reddit/wiki/API%3A-flair
     *
     * @param string $r The name of the subreddit.
     * @param string $name The name of the user.
     * @param string $text The flair text to assign. Note: If an empty string is assigned to both text and css_class, then flair for the user will be removed.
     * @param string $cssClass The CSS class to assign to the flair text. Note: If an empty string is assigned to both text and css_class, then flair for the user will be removed.
     */
    public function getFlair($r, $name, $text, $cssClass)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Posts a CSV file of flair settings to a subreddit.
     * https://github.com/reddit/reddit/wiki/API%3A-flaircsv
     *
     * @param string $r The name of the subreddit.
     * @param string $flairCsv CSV file contents, up to 100 lines.
     */
    public function getFlaircsv($r, $flairCsv)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Sends user feedback to Reddit admins.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $name A name.
     * @param string $email An email.
     * @param string $reason A reason for feedback. Accepted values: ad_inq (advertising inquiry), feedback, i18n (internationalization).
     * @param string $text The feedback.
     */
    public function getPostFeedback($name, $email, $reason, $text)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Reports a thing.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $id The fullname of the thing to report.
     */
    public function getPostReport($id)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Returns search results.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $q Search query. Maximum 500 characters.
     * @param string $sort Sort option. Maximum 10 characters.
     * @param string $t Maximum 10 characters.
     * @param boolean $approval Format: boolean.
     */
    public function getPostSearchfeedback($q, $sort, $t, $approval)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Does something with bookmarklets.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $what Action. Accepted values: like, dislike, save.
     * @param string $u Array of link URLs?
     */
    public function getGetBookmarklet($what, $u)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * FIXME: No Description
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $hexkey Maximum 32 characters.
     * @param string $nickname Maximum 1000 characters.
     * @param string $status Accepted values: new, severe, interesting, normal, fixed.
     */
    public function getPostEditError($hexkey, $nickname, $status)
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Removes the Reddit toolbar if it is enabled in the user's preferences
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     */
    public function getPostNoframe()
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Adds the Reddit toolbar if it is disabled in the user's preferences
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     */
    public function getPostFrame()
    {
        //TODO: Auto-generated method stub
    }

    /**
     * Something related to the "recently viewed" sidebar gadget.
     * http://github.com/reddit/reddit/blob/master/r2/r2/controllers/api.py
     *
     * @param string $type The type of gadget? Accepted value: click.
     * @param string $links A list of links.
     */
    public function getGetGadget($type, $links)
    {
        //TODO: Auto-generated method stub
    }

}
