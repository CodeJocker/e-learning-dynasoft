<?php

namespace App\Listeners;

use App\Events\QuizAnswerSubmitted;
use App\Services\GenericEventDispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Redis;

class UpdateRealtimeLeaderboard implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(
        protected GenericEventDispatcher $dispatcher
    ) {}

    public function handle(QuizAnswerSubmitted $event): void
    {
        // Example: Update Redis Leaderboard
        $quizId = $event->submission->quiz_id;
        $userId = $event->submission->user_id;
        $score = $event->submission->score; // Assuming score is calculated/available

        // Redis ZADD: Add to sorted set
        Redis::zadd("leaderboard:quiz:{$quizId}", $score, $userId);

        // Dispatch a generic event for realtime update
        $this->dispatcher->dispatch('LeaderboardUpdated', [
            'quiz_id' => $quizId,
            'user_id' => $userId,
            'score' => $score,
        ], "quiz.{$quizId}");
    }
}
