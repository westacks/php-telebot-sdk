<?php

namespace WeStacks\TeleBot\Methods;

use WeStacks\TeleBot\Contracts\TelegramMethod;
use WeStacks\TeleBot\Objects\InputFile;
use WeStacks\TeleBot\Objects\Message;
use WeStacks\TeleBot\Objects\MessageEntity;

/**
 * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound). On success, the sent [Message](https://core.telegram.org/bots/api#message) is returned. Bots can currently send animation files of up to 50 MB in size, this limit may be changed in the future.
 *
 * @property string          $chat_id                     __Required: Yes__. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
 * @property InputFile       $animation                   __Required: Yes__. Animation to send. Pass a file_id as String to send an animation that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get an animation from the Internet, or upload a new animation using multipart/form-data. More info on Sending Files »
 * @property int             $duration                    __Required: Optional__. Duration of sent animation in seconds
 * @property int             $width                       __Required: Optional__. Animation width
 * @property int             $height                      __Required: Optional__. Animation height
 * @property InputFile       $thumb                       __Required: Optional__. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://” if the thumbnail was uploaded using multipart/form-data under . More info on Sending Files »
 * @property string          $caption                     __Required: Optional__. Animation caption (may also be used when resending animation by file_id), 0-1024 characters after entities parsing
 * @property string          $parse_mode                  __Required: Optional__. Mode for parsing entities in the animation caption. See formatting options for more details.
 * @property MessageEntity[] $caption_entities            __Required: Optional__. A JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
 * @property bool            $disable_notification        __Required: Optional__. Sends the message silently. Users will receive a notification with no sound.
 * @property bool            $protect_content             __Required: Optional__. Protects the contents of the sent message from forwarding and saving
 * @property int             $reply_to_message_id         __Required: Optional__. If the message is a reply, ID of the original message
 * @property bool            $allow_sending_without_reply __Required: Optional__. Pass True, if the message should be sent even if the specified replied-to message is not found
 * @property Keyboard        $reply_markup                __Required: Optional__. Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
 */
class SendAnimationMethod extends TelegramMethod
{
    protected string $method = 'sendAnimation';

    protected string $expect = 'Message';

    protected array $parameters = [
        'chat_id' => 'string',
        'animation' => 'InputFile',
        'duration' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
        'thumb' => 'InputFile',
        'caption' => 'string',
        'parse_mode' => 'string',
        'caption_entities' => 'MessageEntity[]',
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
            'date' => time(),
            'chat' => [
                'id' => rand(1, 100),
                'type' => 'private',
            ],
            'animation' => [
                'file_id' => 'file_id',
                'file_size' => rand(1, 100),
                'width' => rand(1, 100),
                'height' => rand(1, 100),
            ],
        ]);
    }
}
