<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post as ModelsPost;
use App\Models\PostText;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Post extends Seeder
{

    public function addReplies(ModelsPost $post, Comment $comment){
        $wholesomeReplies = [
            "Thank you so much for your kind words!",
            "I really appreciate your positivity and support!",
            "Your comment made my day!",
            "I'm so grateful for your encouragement.",
            "Your kindness means a lot to me, thank you!",
            "Thank you for always being so supportive!",
            "I'm glad to hear that, thank you!",
            "Your words are so uplifting, thank you!",
            "Thank you for your thoughtful comment!",
            "I'm really touched by your kindness.",
            "Your support truly means the world to me!",
            "Thank you for always brightening my day!",
            "I'm so happy to have your support, thank you!",
            "Your positive energy is much appreciated!",
            "Thank you for being so wonderful!",
            "I’m grateful for your kind words and support!",
            "Your comment was just what I needed, thank you!",
            "Thank you for always being so encouraging!",
            "Your kindness never goes unnoticed, thank you!",
            "Thank you for your lovely comment!",
            "Your words mean so much to me, thank you!",
            "I'm so glad you think so, thank you!",
            "That really made my day, thank you!",
            "I'm deeply touched by your kindness!",
            "Thank you, your support is truly appreciated!",
            "You always know how to make me smile, thank you!",
            "I'm so grateful for your encouraging words!",
            "Thank you for your thoughtful message!",
            "Your positivity is infectious, thank you!",
            "Thank you, it means a lot coming from you!",
            "I'm so happy to hear that, thank you!",
            "Thank you, your kindness is greatly appreciated!",
            "You always lift my spirits, thank you!",
            "I'm so glad to have your support, thank you!",
            "Your kind words really made a difference, thank you!",
            "Thank you for being so amazing!",
            "I'm truly grateful for your kind words!",
            "Your support means everything to me, thank you!",
            "Thank you, I really appreciate your thoughtfulness!",
            "Your encouragement is so motivating, thank you!"
        ];
        $wholesomeReplies = collect($wholesomeReplies)->shuffle()->slice(0, rand(3, 6))->map(fn($reply) => [
            'text' => $reply,
            'user_id' => rand(1110, 1380),
            'comment_id' => $comment->id,
        ]);

        $post->comments()->createMany($wholesomeReplies);
    }

    public function addComments(ModelsPost $post){
        $wholesomeComments = [
            "You always bring such positive energy to our community. Thank you!",
            "Your contributions make a huge difference. We appreciate you!",
            "You're doing an amazing job. Keep up the great work!",
            "Your kindness and generosity do not go unnoticed. Thank you for being you!",
            "I'm so glad you're part of our team. Your enthusiasm is contagious!",
            "Your dedication and hard work are truly inspiring.",
            "You have a unique talent for making everyone feel welcome and valued.",
            "Thank you for always being so helpful and supportive.",
            "Your creativity and innovation never cease to amaze me.",
            "You bring out the best in everyone around you. Thank you for your positivity!",
            "Your passion and commitment are truly admirable.",
            "You always find the silver lining in every situation. It's truly uplifting!",
            "Thank you for your continuous efforts and the positivity you spread.",
            "You make our community a better place just by being here.",
            "Your smile and positive attitude brighten everyone's day.",
            "Your hard work and dedication are greatly appreciated.",
            "You have such a wonderful impact on our community. Thank you!",
            "Your support and encouragement mean the world to us.",
            "You have a remarkable ability to make people feel special and appreciated.",
            "Thank you for bringing so much joy and positivity into our lives.",
            "You're such a wonderful person!",
            "Your smile always brightens my day.",
            "I appreciate your kindness and generosity.",
            "You have a heart of gold.",
            "Your positivity is contagious.",
            "You make the world a better place.",
            "I'm grateful for your friendship.",
            "You're an inspiration to us all.",
            "Your hard work is truly appreciated.",
            "You have an amazing sense of humor.",
            "You always know how to make me smile.",
            "Your creativity is astounding.",
            "You have a wonderful perspective on life.",
            "Thank you for being you.",
            "You make everything better just by being here.",
            "Your passion is truly inspiring.",
            "You bring so much joy into the world.",
            "You have a great eye for detail.",
            "Your support means the world to me.",
            "You're a fantastic listener."
        ];

        $wholesomeComments = collect($wholesomeComments)->shuffle()->slice(0, rand(20, 40))->map(fn($comment) => [
            'text' => $comment,
            'user_id' => rand(1110, 1380)
        ]);

        $post->comments()->createMany($wholesomeComments)->each(fn(Comment $comment) => $this->addReplies($post, $comment));
    }

    public function addPosts(){
        $wholesomeMessages = [
            [
                "title" => "A Heartfelt Thank You",
                "paragraph" => "Words can't express how grateful I am for your unwavering support and kindness. You have a remarkable ability to brighten the darkest days with your positivity. Thank you for being such an amazing friend and for always being there when I need you most. Your generosity and compassion are truly inspiring, and I feel incredibly lucky to have you in my life."
            ],
            [
                "title" => "You Make a Difference",
                "paragraph" => "Every day, your actions make the world a better place. Your thoughtful gestures and caring nature leave a lasting impact on everyone you meet. Thank you for always being a beacon of light and for spreading joy wherever you go. Your dedication and kindness do not go unnoticed, and we are all better for knowing you."
            ],
            [
                "title" => "The Gift of Friendship",
                "paragraph" => "Friendship is one of life's greatest treasures, and having you as a friend is a true blessing. Your understanding and patience have helped me through countless challenges, and your laughter has brightened many days. Thank you for being a constant source of support and for sharing your wonderful spirit with me. I cherish our friendship more than words can say."
            ],
            [
                "title" => "Celebrating Your Kindness",
                "paragraph" => "Your kindness is like a warm hug on a cold day, bringing comfort and joy to everyone around you. It's people like you who remind us of the goodness in the world. Thank you for your selfless acts and for always putting others first. Your heart of gold shines brightly, and the world is a better place because of you."
            ],
            [
                "title" => "Appreciation for Your Support",
                "paragraph" => "In times of need, you have always been there to offer your unwavering support. Your encouraging words and thoughtful advice have guided me through many obstacles. Thank you for being such a dependable and compassionate friend. Your support means the world to me, and I am eternally grateful for everything you do."
            ],
            [
                "title" => "Your Bright Light",
                "paragraph" => "Your presence brings a unique sparkle to every moment. Whether through your kind words or thoughtful actions, you light up the lives of those around you. Thank you for being a beacon of positivity and warmth. Your genuine spirit is a gift to all who know you, and I am incredibly thankful for your friendship."
            ],
            [
                "title" => "Incredible You",
                "paragraph" => "It's truly amazing how you touch the lives of everyone you meet. Your kindness, patience, and understanding are unmatched. Thank you for always going above and beyond to make others feel valued and loved. The world is a much brighter place with you in it, and I'm so grateful for your incredible presence."
            ],
            [
                "title" => "A True Inspiration",
                "paragraph" => "Your strength and resilience are an inspiration to us all. You handle life's challenges with grace and optimism, never failing to lift others up in the process. Thank you for being such a positive role model and for sharing your wisdom and encouragement so freely. Your influence makes a profound difference."
            ],
            [
                "title" => "Grateful for You",
                "paragraph" => "I want you to know how deeply grateful I am for your unwavering support and friendship. Your constant encouragement and caring nature have made a lasting impact on my life. Thank you for always being there with a kind word or a helping hand. Your generosity and compassion are truly remarkable."
            ],
            [
                "title" => "Your Thoughtful Ways",
                "paragraph" => "Your thoughtfulness never ceases to amaze me. You always seem to know just what to say and do to make someone’s day better. Thank you for your endless kindness and for being such a wonderful friend. Your ability to spread joy and comfort is a rare and beautiful gift that I deeply appreciate."
            ],
            [
                "title" => "A Night to Remember",
                "paragraph" => "Last night's event was truly magical. The atmosphere was filled with joy and excitement, and your presence made it even more special. Thank you for bringing your wonderful energy and for being part of such a memorable evening. Your enthusiasm and warmth were felt by everyone, making it a night we will all cherish forever."
            ],
            [
                "title" => "A Day of Celebration",
                "paragraph" => "What an incredible day of celebration we had! Your participation and positive spirit added so much to the festivities. Thank you for being there and for making the event so enjoyable for everyone. Your contribution helped create unforgettable memories, and we are so grateful for your presence and support."
            ],
            [
                "title" => "Unforgettable Moments",
                "paragraph" => "The event was filled with unforgettable moments, thanks in large part to you. Your enthusiasm and kindness made everyone feel welcome and included. Thank you for sharing your time and for making the occasion so special. Your impact was truly felt, and we will always remember your wonderful contribution to the event."
            ],
            [
                "title" => "A Gathering of Joy",
                "paragraph" => "The gathering was a true testament to the power of community and joy. Your participation and cheerful demeanor were highlights of the event. Thank you for bringing such positive vibes and for helping to create a joyful atmosphere. It was a pleasure to share this experience with you, and your presence made it all the more meaningful."
            ],
            [
                "title" => "Celebrating Together",
                "paragraph" => "Celebrating together was a beautiful experience, and your presence made it even better. Thank you for being part of the event and for contributing to the wonderful atmosphere. Your kindness and positive energy were contagious, making the celebration truly special. We are so thankful for your involvement and support."
            ],
            [
                "title" => "A Reunion of Hearts",
                "paragraph" => "The alumni reunion at Arellano University was a heartwarming event, filled with nostalgia and joy. Seeing old friends and reminiscing about our shared experiences brought smiles to everyone's faces. Thank you for joining us and for contributing to such a memorable occasion. Your presence added a special touch to the celebration, and we are grateful for the beautiful memories we created together."
            ],
            [
                "title" => "Celebrating Our Legacy",
                "paragraph" => "Our alumni event at Arellano University was a beautiful celebration of our collective legacy. It was wonderful to reconnect and share stories of our journeys since graduation. Thank you for being a part of this special day and for your continued dedication to our alma mater. Your support and enthusiasm were truly inspiring, making the event an unforgettable experience."
            ],
            [
                "title" => "Together Again",
                "paragraph" => "Being together again at Arellano University brought back so many cherished memories. The event was filled with laughter, heartfelt conversations, and the joy of reconnecting with old friends. Thank you for attending and for making the reunion so special. Your participation and warmth made it a day to remember, and we look forward to many more gatherings in the future."
            ],
            [
                "title" => "Honoring Our Past, Embracing Our Future",
                "paragraph" => "The alumni gathering at Arellano University was a wonderful opportunity to honor our past and embrace our future. The stories shared and the connections rekindled highlighted the enduring bond we all share. Thank you for being part of this meaningful event and for your unwavering support. Your presence and contributions are deeply valued and appreciated."
            ],
            [
                "title" => "A Celebration of Friendship",
                "paragraph" => "The alumni event at Arellano University was a true celebration of friendship and community. It was amazing to see familiar faces and catch up on each other's lives. Thank you for attending and for bringing your positive energy and spirit. Your involvement made the event truly special, and we are so grateful for the lasting friendships and memories we continue to create."
            ]

        ];

        foreach($wholesomeMessages as $message){
            $text = PostText::create([
                'content' => $message['paragraph'],
            ]);

            $post = $text->post()->create([
                'user_id' => rand(1110, 1380),
                'privacy' => 'public',
                'title' => $message['title']
            ]);

            $this->addComments($post);
        }
    }

    public function AddReactions(){
        Comment::all()->each(function(Comment $comment){
            $comment->reactions_count = rand(66, 666);
            $comment->save();
        });

        ModelsPost::all()->each(function(ModelsPost $post){
            $post->reactions_count = rand(66, 666);
            $post->save();

            User::whereHas('posts', fn($query) => $query->where('id', $post->id))->increment('reactions_count', $post->reactions_count);
        });

    }

    public function AddShares(){
        ModelsPost::all()->each(function(ModelsPost $post){
            $post->shares_count = rand(66, 666);
            $post->save();

            User::whereHas('posts', fn($query) => $query->where('id', $post->id))->increment('shares_count', $post->shares_count);
        });
    }


    public function run(): void
    {
        $this->addPosts();

        // $this->AddShares();
    }
}
