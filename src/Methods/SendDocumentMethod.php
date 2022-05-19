<?php

namespace WeStacks\TeleBot\Methods;

use WeStacks\TeleBot\Contracts\TelegramMethod;
use WeStacks\TeleBot\Objects\InputFile;
use WeStacks\TeleBot\Objects\Message;
use WeStacks\TeleBot\Objects\MessageEntity;

/**
 * Use this method to send general files. On success, the sent [Message](https://core.telegram.org/bots/api#message) is returned. Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
 *
 * @property string          $chat_id                        __Required: Yes__. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
 * @property InputFile       $document                       __Required: Yes__. File to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data. More info on Sending Files »
 * @property InputFile       $thumb                          __Required: Optional__. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://” if the thumbnail was uploaded using multipart/form-data under . More info on Sending Files »
 * @property string          $caption                        __Required: Optional__. Document caption (may also be used when resending documents by file_id), 0-1024 characters after entities parsing
 * @property string          $parse_mode                     __Required: Optional__. Mode for parsing entities in the document caption. See formatting options for more details.
 * @property MessageEntity[] $caption_entities               __Required: Optional__. A JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
 * @property bool            $disable_content_type_detection __Required: Optional__. Disables automatic server-side content type detection for files uploaded using multipart/form-data
 * @property bool            $disable_notification           __Required: Optional__. Sends the message silently. Users will receive a notification with no sound.
 * @property bool            $protect_content                __Required: Optional__. Protects the contents of the sent message from forwarding and saving
 * @property int             $reply_to_message_id            __Required: Optional__. If the message is a reply, ID of the original message
 * @property bool            $allow_sending_without_reply    __Required: Optional__. Pass True, if the message should be sent even if the specified replied-to message is not found
 * @property Keyboard        $reply_markup                   __Required: Optional__. Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
 */
class SendDocumentMethod extends TelegramMethod
{
    protected string $method = 'sendDocument';

    protected string $expect = 'Message';

    protected array $parameters = [
        'chat_id' => 'string',
        'document' => 'InputFile',
        'thumb' => 'InputFile',
        'caption' => 'string',
        'parse_mode' => 'string',
        'caption_entities' => 'MessageEntity[]',
        'disable_content_type_detection' => 'boolean',
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
                'is_bot' => false,
                'first_name' => 'Bot',
            ],
            'chat' => [
                'id' => $arguments['chat_id'],
                'type' => 'private',
            ],
            'date' => time(),
            'document' => [
                'file_id' => 'test',
                'thumb' => [
                    'file_id' => 'test',
                    'width' => 0,
                    'height' => 0,
                ],
                'file_name' => 'test',
                'mime_type' => 'test',
                'file_size' => 0,
            ],
        ]);
    }
}
