<?php

namespace WeStacks\TeleBot\Methods;

use WeStacks\TeleBot\Contracts\TelegramMethod;
use WeStacks\TeleBot\Objects\InputFile;
use WeStacks\TeleBot\Objects\Message;
use WeStacks\TeleBot\Objects\MessageEntity;

/**
 * Use this method to send audio files, if you want Telegram clients to display them in the music player. Your audio must be in the .MP3 or .M4A format. On success, the sent [Message](https://core.telegram.org/bots/api#message) is returned. Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
 *
 * For sending voice messages, use the [sendVoice](https://core.telegram.org/bots/api#sendvoice) method instead.
 *
 * @property string          $chat_id                     __Required: Yes__. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
 * @property InputFile       $audio                       __Required: Yes__. Audio file to send. Pass a file_id as String to send an audio file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get an audio file from the Internet, or upload a new one using multipart/form-data. More info on Sending Files »
 * @property string          $caption                     __Required: Optional__. Audio caption, 0-1024 characters after entities parsing
 * @property string          $parse_mode                  __Required: Optional__. Mode for parsing entities in the audio caption. See formatting options for more details.
 * @property MessageEntity[] $caption_entities            __Required: Optional__. A JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
 * @property int             $duration                    __Required: Optional__. Duration of the audio in seconds
 * @property string          $performer                   __Required: Optional__. Performer
 * @property string          $title                       __Required: Optional__. Track name
 * @property InputFile       $thumb                       __Required: Optional__. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://” if the thumbnail was uploaded using multipart/form-data under . More info on Sending Files »
 * @property bool            $disable_notification        __Required: Optional__. Sends the message silently. Users will receive a notification with no sound.
 * @property bool            $protect_content             __Required: Optional__. Protects the contents of the sent message from forwarding and saving
 * @property int             $reply_to_message_id         __Required: Optional__. If the message is a reply, ID of the original message
 * @property bool            $allow_sending_without_reply __Required: Optional__. Pass True, if the message should be sent even if the specified replied-to message is not found
 * @property Keyboard        $reply_markup                __Required: Optional__. Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
 */
class SendAudioMethod extends TelegramMethod
{
    protected string $method = 'sendAudio';

    protected string $expect = 'Message';

    protected array $parameters = [
        'chat_id' => 'string',
        'audio' => 'InputFile',
        'caption' => 'string',
        'parse_mode' => 'string',
        'caption_entities' => 'MessageEntity[]',
        'duration' => 'integer',
        'performer' => 'string',
        'title' => 'string',
        'thumb' => 'InputFile',
        'disable_notification' => 'boolean',
        'protect_content' => 'boolean',
        'reply_to_message_id' => 'integer',
        'allow_sending_without_reply' => 'boolean',
        'reply_markup' => 'Keyboard',
    ];

    public function mock($arguments)
    {
        return new Message([
            'message_id' => rand(1, 100),
            'from' => [
                'id' => rand(1, 100),
                'is_bot' => true,
                'first_name' => 'Bot',
            ],
            'chat' => [
                'id' => $arguments['chat_id'],
                'type' => 'private',
            ],
            'date' => time(),
            'audio' => [
                'file_id' => 'test',
                'duration' => rand(1, 100),
                'mime_type' => 'audio/mpeg',
                'file_size' => rand(1, 100),
            ],
        ]);
    }
}
