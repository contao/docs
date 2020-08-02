---
title: 'Mumble Installation'
description: 'The Mumble installation. If you want to participate in the Contao calls.'
aliases:
    - /en/guides/mumble/
weight: 890
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

## What is Mumble

Mumble is an audio chat in which you can talk with several people. Additionally there is the possibility to enter short information in a chat window. Mumble is usually divided into several rooms, so that one can also retreat into a room in smaller groups or in pairs.

The Contao calls will take place in Mumble. You can find out when the next Contao Mumble call will take place on the [project website](https://contao.org/de/mumble-calls.html) .

You can find out more about Mumble at [mumble.info](https://www.mumble.info/) .

## Installation

To install it, you need to [download](https://www.mumble.info/downloads/) and run the appropriate files for your operating system. You only need the Mumble client - the installation of the Mumble server application is not necessary.

## Set up Mumble

After the first start of Mumble the "Audio Settings Wizard" should open. All settings can also be adjusted afterwards.

![Mumble Audio setup wizard](/de/guides/images/de/mumble/mumble-audio-assistant.jpg?classes=shadow)

If you press the "Next" button you can select your preferred audio input and output devices on the next screen.

![Mumble Audio Setup Wizard Device Selection](/de/guides/images/de/mumble/mumble-audio-assistant-geraeteauswahl.jpg?classes=shadow)

In the next screen the performance of the sound card is determined. This is described in the wizard window. So you hear a text and should move the slider under the text to the left as far as possible without the quality of the read text getting worse or starting to falter.

![Mumble Audio Setup Wizard Device Setup](/de/guides/images/de/mumble/mumble-audio-assistant-geraeteeinstellungen.jpg?classes=shadow)

The next step deals with the volume settings. If you follow the instructions on the screen, you should find the optimal setting.

![Mumble Audio Settings Wizard Volume](/de/guides/images/de/mumble/mumble-audio-assistant-lautstaerkeneinstellungen-mikro.jpg?classes=shadow)

Let's move on to voice activity detection. This is used to set the point at which the "sounds" recorded by the microphone are classified as speech. We recommend keeping the "Input raw amplitude" setting for now. Then you can move the slider under the activity bar to the middle.

When you are in Mumble, you can adjust this setting even better, but this is how it should work for now. On this screen you can already see the icon as an avatar, which changes from green to blue when speech is recognized and activated and additionally shows "sound waves" - this is a sign for your own speech input. Also in the later Mumble status window this icon will be visible with the color change and shows who is currently speaking.

![Mumble Audio Settings Wizard Voice Activation](/de/guides/images/de/mumble/mumble-audio-assistant-sprachaktivitaetserkennung.jpg?classes=shadow)

The following screen would like to ask for two more settings regarding quality and hints. You can leave the quality on "balanced". For the notifications we recommend to activate the option "Disable text-to-speech and use sounds", because especially "text-to-speech" can cause a lot of confusion at the beginning.

![Mumble Audio Settings Wizard Voice Quality](/de/guides/images/de/mumble/mumble-audio-assistant-qualitaet-hinweise.jpg?classes=shadow)

The last point is actually only interesting for use with games and can be ignored. If you use headphones, you can check the box "Use headphones".

![Mumble Audio Setting Wizard Audio Position](/de/guides/images/de/mumble/mumble-audio-assistant-positionsabhaengiges-audio.jpg?classes=shadow)

The audio configuration is now complete.

## Certificate Management

At Mumble you generally do not have to think of a username or password, but you are identified with the help of a certificate. If you already have a certificate (e.g. a mail certificate or similar) you can use it. But you can also get a certificate from Mumble.

![Mumble Certificate Management](/de/guides/images/de/mumble/mumble-zertifikat-management.jpg?classes=shadow)

## Select Mumble server

There are many different Mumble servers all over the world, but we only want one specific one and therefore you have to tell Mumble the access data for the "CCA Mumble server". To do this, simply click on "Add server" in the appearing screen.

![Mumble Server Connection](/de/guides/images/de/mumble/mumble-server-verbinden.jpg?classes=shadow)

The following data should be entered:

- **Designation:** Can be freely selected, e.g. CCA-Mumble-Server
- **Address:** mumble.c-c-a.org
- **Port:** 62492
- **Username:** Can be freely chosen

In the server list, the "CCA-Mumble-Server" should now appear under Favorites. Select this entry and click on "Connect".

![Select Mumble Server Connection](/de/guides/images/de/mumble/mumble-server-auswaehlen.jpg?classes=shadow)

## Mumble status window

Congratulations, because when you see the following window, you are in "Mumble". If you log on to the Mumble server, you are always automatically moved to the "Mos Eisley Bar" at the beginning. This is a kind of virtual lounge. Otherwise the "CCA Mumble server" is divided into the following "main channels" (so-called channels): "Galaxy" and "Universe".

These in turn into different subchannels. All channels in the "Universe" are freely accessible to everyone, and in the "Galaxy" the channels "Galactic Games", "Galactic Salad" and "Galactic Senate" with "open Senate" are also accessible to you.

In the channel "closed senate" (in "Galactic Senate") only administrators are allowed. But these administrators can invite all others to the channel and assign them language rights.

{{% notice note %}}
 If you have set in the audio setup that Mumble automatically detects the language status, from now on every word/sound is transmitted to Mumble if you don't mute yourself. 
{{% /notice %}}

![Mumble Status Window](/de/guides/images/de/mumble/mumble-statusfenster.jpg?classes=shadow)

## Troubleshooting

If someone should encounter problems during the setup, then simply write the CCA via Twitter ( [CCA at Twitter](https://twitter.com/ContaoCA) ), via Facebook ( [CCA at Facebook](https://www.facebook.com/contao.community.alliance) ) or one of the other [communication channels](https://c-c-a.org/aktuelles/news/details/contao-kommunikationskanaele). We are happy to help.

If there are still language problems after successful setup, we can help directly in Mumble. If someone is active in the Mumble and can help, you can find out live on [CCA website](https://c-c-a.org/aktuelles/news) in the box "Mumble status".

Under the menu item "Preferences" there is (under Windows/Linux bottom left, under Mac OS X top right) the item "Advanced".

Now look under "Audio input" to see if a deflection is measured when you speak into the microphone. If there is no deflection, no sound at all is picked up by the microphone. Therefore you should check under "Audio input" the item "Device" (under "Interface") to see if the appropriate input source/microphone is selected.

If there is a rash under "Audio output", but it only remains in the red area, you should move the "Silence until" and "Speech over" sliders so that the rash is in the green area.

### Importance of the areas:

- **Yellow area:** Here the transmission is still going on, if it was in the green area before.
- **Red area:** Even if a rash is visible here, nothing is transferred.
