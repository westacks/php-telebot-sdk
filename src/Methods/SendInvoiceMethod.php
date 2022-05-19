<?php

namespace WeStacks\TeleBot\Methods;

use WeStacks\TeleBot\Contracts\TelegramMethod;
use WeStacks\TeleBot\Objects\InlineKeyboardMarkup;
use WeStacks\TeleBot\Objects\LabeledPrice;
use WeStacks\TeleBot\Objects\Message;

/**
 * Use this method to send invoices. On success, the sent [Message](https://core.telegram.org/bots/api#message) is returned.
 *
 * @property string               $chat_id                       __Required: Yes__. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
 * @property string               $title                         __Required: Yes__. Product name, 1-32 characters
 * @property string               $description                   __Required: Yes__. Product description, 1-255 characters
 * @property string               $payload                       __Required: Yes__. Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use for your internal processes.
 * @property string               $provider_token                __Required: Yes__. Payments provider token, obtained via Botfather
 * @property string               $currency                      __Required: Yes__. Three-letter ISO 4217 currency code, see more on currencies
 * @property LabeledPrice[]       $prices                        __Required: Yes__. Price breakdown, a JSON-serialized list of components (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.)
 * @property int                  $max_tip_amount                __Required: Optional__. The maximum accepted amount for tips in the smallest units of the currency (integer, not float/double). For example, for a maximum tip of US$ 1.45 pass max_tip_amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies). Defaults to 0
 * @property int[]                $suggested_tip_amounts         __Required: Optional__. A JSON-serialized array of suggested amounts of tips in the smallest units of the currency (integer, not float/double). At most 4 suggested tip amounts can be specified. The suggested tip amounts must be positive, passed in a strictly increased order and must not exceed max_tip_amount.
 * @property string               $start_parameter               __Required: Optional__. Unique deep-linking parameter. If left empty, forwarded copies of the sent message will have a Pay button, allowing multiple users to pay directly from the forwarded message, using the same invoice. If non-empty, forwarded copies of the sent message will have a URL button with a deep link to the bot (instead of a Pay button), with the value used as the start parameter
 * @property string               $provider_data                 __Required: Optional__. A JSON-serialized data about the invoice, which will be shared with the payment provider. A detailed description of required fields should be provided by the payment provider.
 * @property string               $photo_url                     __Required: Optional__. URL of the product photo for the invoice. Can be a photo of the goods or a marketing image for a service. People like it better when they see what they are paying for.
 * @property int                  $photo_size                    __Required: Optional__. Photo size
 * @property int                  $photo_width                   __Required: Optional__. Photo width
 * @property int                  $photo_height                  __Required: Optional__. Photo height
 * @property bool                 $need_name                     __Required: Optional__. Pass True, if you require the user's full name to complete the order
 * @property bool                 $need_phone_number             __Required: Optional__. Pass True, if you require the user's phone number to complete the order
 * @property bool                 $need_email                    __Required: Optional__. Pass True, if you require the user's email address to complete the order
 * @property bool                 $need_shipping_address         __Required: Optional__. Pass True, if you require the user's shipping address to complete the order
 * @property bool                 $send_phone_number_to_provider __Required: Optional__. Pass True, if user's phone number should be sent to provider
 * @property bool                 $send_email_to_provider        __Required: Optional__. Pass True, if user's email address should be sent to provider
 * @property bool                 $is_flexible                   __Required: Optional__. Pass True, if the final price depends on the shipping method
 * @property bool                 $disable_notification          __Required: Optional__. Sends the message silently. Users will receive a notification with no sound.
 * @property bool                 $protect_content               __Required: Optional__. Protects the contents of the sent message from forwarding and saving
 * @property int                  $reply_to_message_id           __Required: Optional__. If the message is a reply, ID of the original message
 * @property bool                 $allow_sending_without_reply   __Required: Optional__. Pass True, if the message should be sent even if the specified replied-to message is not found
 * @property InlineKeyboardMarkup $reply_markup                  __Required: Optional__. A JSON-serialized object for an inline keyboard. If empty, one 'Pay total price' button will be shown. If not empty, the first button must be a Pay button.
 */
class SendInvoiceMethod extends TelegramMethod
{
    protected string $method = 'sendInvoice';

    protected string $expect = 'Message';

    protected array $parameters = [
        'chat_id' => 'string',
        'title' => 'string',
        'description' => 'string',
        'payload' => 'string',
        'provider_token' => 'string',
        'currency' => 'string',
        'prices' => 'LabeledPrice[]',
        'max_tip_amount' => 'integer',
        'suggested_tip_amounts' => 'integer[]',
        'start_parameter' => 'string',
        'provider_data' => 'string',
        'photo_url' => 'string',
        'photo_size' => 'integer',
        'photo_width' => 'integer',
        'photo_height' => 'integer',
        'need_name' => 'boolean',
        'need_phone_number' => 'boolean',
        'need_email' => 'boolean',
        'need_shipping_address' => 'boolean',
        'send_phone_number_to_provider' => 'boolean',
        'send_email_to_provider' => 'boolean',
        'is_flexible' => 'boolean',
        'disable_notification' => 'boolean',
        'protect_content' => 'boolean',
        'reply_to_message_id' => 'integer',
        'allow_sending_without_reply' => 'boolean',
        'reply_markup' => 'InlineKeyboardMarkup',
    ];

    public function mock($arguments)
    {
        return new Message([
            'message_id' => mt_rand(1, 100),
            'date' => time(),
            'chat' => [
                'id' => $arguments['chat_id'],
                'type' => 'private',
            ],
            'text' => '',
        ]);
    }
}
