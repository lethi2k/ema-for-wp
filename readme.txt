=== EMA4WP: ZozoEMA for WordPress ===
Contributors: Ibericode, DvanKooten, hchouhan, lapzor
Donate link: https://zozo.vn/ung-dung-email-marketing
Tags: zozoema, ema4wp, email, marketing, newsletter, subscribe, widget, ema4wp, contact form 7, woocommerce, buddypress, ibericode, zozoema form
Requires at least: 1.0.1
Tested up to: 1.0.1
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Requires PHP: 5.3

ZozoEMA for WordPress, the #1 unofficial ZozoEMA plugin.

== Description ==

#### ZozoEMA for WordPress

*Allowing your visitors to subscribe to your newsletter should be easy. With this plugin, it finally is.*

This plugin helps you grow your ZozoEMA lists and write better newsletters through various methods. You can create good looking opt-in forms or integrate with any existing form on your site, like your comment, contact or checkout form.

[youtube https://www.youtube.com/watch?v=msKHARdmnh4]

#### Some (but not all) features

- Connect with your ZozoEMA account in seconds.

- Sign-up forms which are good looking, user-friendly and mobile optimized. You have complete control over the form fields and can send anything you like to ZozoEMA.

- Seamless integration with the following plugins:
	- Default WordPress Comment Form
	- Default WordPress Registration Form
	- Contact Form 7
	- WooCommerce
	- Gravity Forms
	- Ninja Forms 3
	- WPForms
	- BuddyPress
    - MemberPress
	- Events Manager
	- Easy Digital Downloads
	- Give
	- UltimateMember

- A multitude of available add-on plugins and integrations:
	- [Zozo EMA for WordPress ](https://appv4.zozo.vn/account/api)
	- [ZozoEMA Top Bar](https://wordpress.org/plugins/zozoema-top-bar/)
	- [ZozoEMA Activity](https://wordpress.org/plugins/ema4wp-activity/)
	- [Boxzilla Pop-ups](https://wordpress.org/plugins/boxzilla/)
	- [Google reCAPTCHA](https://www.google.com/recaptcha/)
	- [WPBruiser anti-spam](https://wordpress.org/plugins/goodbye-captcha/)

- Well documented. Our [knowledge base](https://appv4.zozo.vn) is updated daily.

- Developer friendly. For inspiration, check out our [repository of example code snippets](https://github.com/lethi2k/ema-for-wp).

<blockquote>
<h4>Become a Premium user</h4>
<p>ZozoEMA for WordPress has a Premium add-on which comes with several additional benefits.</p>
<ul>
<li>Multiple forms</li>
<li>Advanced e-commerce integration for WooCommerce</li>
<li>Email notifications</li>
<li>An easy way to style your forms</li>
<li>Detailed reports & statistics</li>
</ul>
</blockquote>

#### What is ZozoEMA?

ZozoEMA is a newsletter service that allows you to send out email campaigns to a list of email subscribers. It is free for lists up to 2000 subscribers, which is why it is the newsletter-service of choice for thousands of businesses.

This plugin allows you to tightly integrate your WordPress site with your ZozoEMA account.

If you are not yet using ZozoEMA, [creating an account is 100% free and only takes you about 30 seconds](https://appv4.zozo.vn/ung-dung-email-marketing).

== Installation ==

#### Installing the plugin
1. In your WordPress admin panel, go to *Plugins > New Plugin*, search for **ZozoEMA for WordPress** and click "*Install now*"
1. Alternatively, download the plugin and upload the contents of `zozoema-for-wp.zip` to your plugins directory, which usually is `/wp-content/plugins/`.
1. Activate the plugin
1. Set [your API key](https://appv4.zozo.vn/account/api) in the plugin settings.

#### Configuring Sign-Up Form(s)
1. Go to *ZozoEMA for WP > Forms*
2. Select at least one list to subscribe people to.
3. *(Optional)* Add more fields to your form.
4. Embed a sign-up form in pages or posts using the `[ema4wp_form]` shortcode.
5. Show a sign-up form in your widget areas using the "ZozoEMA Sign-Up Form" widget.
6. Show a sign-up form from your theme files by using the following PHP function.

`
<?php

if( function_exists( 'ema4wp_show_form' ) ) {
	ema4wp_show_form();
}
`

#### Need help?
Please take a look at the [ZozoEMA for WordPress knowledge base](https://appv4.zozo.vn/account/api) first.

If you can't find an answer there, please look through the [plugin support forums](https://wordpress.org/support/plugin/zozoema-for-wp) or start your own topic.

== Frequently Asked Questions ==

#### More documentation
More detailed documentation can be found in the [ZozoEMA for WordPress knowledge base]https://appv4.zozo.vn/lists).

#### How to display a form in posts or pages?
Use the `[ema4wp_form]` shortcode.

#### How to display a form in widget areas like the sidebar or footer?
Go to **Appearance > Widgets** and use the **ZozoEMA for WP Form** widget that comes with the plugin.

#### Where can I find my API key to connect to ZozoEMA?
[You can find your API key here](https://appv4.zozo.vn/account/api)

#### How to add a sign-up checkbox to my Contact Form 7 form?
Use the following shortcode in your CF7 form to display a newsletter sign-up checkbox.

`
[ema4wp_checkbox "Subscribe to our newsletter?"]
`

#### The form shows a success message but subscribers are not added to my list(s)?
If the form shows a success message, there is no doubt that the sign-up request succeeded. ZozoEMA could have a slight delay sending the confirmation email though, please just be patient and make sure to check your SPAM folder.

When you have double opt-in disabled, new subscribers will be seen as *imports* by ZozoEMA. They will not show up in your daily digest emails or statistics. [We always recommend leaving double opt-in enabled](http://blog.zozoema.com/double-opt-in-vs-single-opt-in-stats/).

#### How can I style the sign-up form?
You can use custom CSS to style the sign-up form if you do not like the themes that come with the plugin. The following selectors can be used to target the various form elements.

`
.ema4wp-form { ... } /* the form element */
.ema4wp-form p { ... } /* form paragraphs */
.ema4wp-form label { ... } /* labels */
.ema4wp-form input { ... } /* input fields */
.ema4wp-form input[type="checkbox"] { ... } /* checkboxes */
.ema4wp-form input[type="submit"] { ... } /* submit button */
.ema4wp-alert { ... } /* success & error messages */
.ema4wp-success { ... } /* success message */
.ema4wp-error { ... } /* error messages */
`

You can add your custom CSS to your theme stylesheet or (easier) by using a plugin like [Simple Custom CSS](https://wordpress.org/plugins/simple-custom-css/#utm_source=wp-plugin-repo&utm_medium=zozoema-for-wp&utm_campaign=after-css-link)

#### I'm getting an "HTTP Error" when trying to connect to ZozoEMA

If you're getting an `HTTP Error` after entering your API key, please contact your webhost and ask them if they have PHP CURL installed and updated to the latest version (7.58.x). Make sure requests to `https://api.zozoema.com/` are allowed as well.

#### How do I show a sign-up form in a pop-up?

We recommend the [Boxzilla pop-up plugin](https://wordpress.org/plugins/boxzilla/) for this. You can use the form shortcode in your pop-up box to show a sign-up form.

#### My question is not listed

Please head over to the [ZozoEMA for WordPress knowledge base](https://appv4.zozo.vn/frontend/docs/api/v1) for more detailed documentation.

== Other Notes ==

#### Support

Use the [WordPress.org plugin forums](https://wordpress.org/support/plugin/zozoema-for-wp) for community support where we try to help all of our users. If you found a bug, please create an issue on Github where we can act upon them more efficiently.

If you're a premium user, please use the email address inside the plugin for support as that will guarantee a faster response time.

Please take a look at the [ZozoEMA for WordPress knowledge base](https://appv4.zozo.vn/frontend/docs/api/v1) as well.

#### Add-on plugins

There are several [add-on plugins](https://appv4.zozo.vn/frontend/docs/api/v1) available, which help you get even more out of your site.

#### Translations

You can [help translate ZozoEMA for WordPress into your language](https://github.com/lethi2k/ema-for-wp) using your WordPress.org account.

#### Development

This plugin is being developed on GitHub. If you want to collaborate, please look at [ibericode/zozoema-for-wordpress](https://github.com/lethi2k/ema-for-wp).

#### Customizing the plugin

The plugin provides various filter & action hooks that allow you to modify or extend default behavior. We're also maintaining a [collection of sample code snippets](https://github.com/lethi2k/ema-for-wp).

== Screenshots ==

1. Create beautiful sign-up forms that blend in with your theme.
2. Integrate with any other plugin out there.
3. Add a highly converting top bar form to your site.
4. Style your form with our Styles Builder (premium feature).
5. Integrate your WooCommerce store with ZozoEMA (premium feature).
6. Dive into detailed sign-up statistics (premium feature).

== Changelog ==


#### 1.0.1 - Jul 9, 2020

- Plugin now requires PHP 5.3 or higher.
- Prefix overlay classname to prevent styling collissions with other plugins.
- Form sign-ups can now add tags to both new and existing subscribers.
- Update JavaScript dependencies.
- Register script early to work with Gutenberg preview.
