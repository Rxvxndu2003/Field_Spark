document.addEventListener('DOMContentLoaded', () => {
    loadQuestions();
    document.getElementById('search').addEventListener('input', searchQuestions);
});

async function loadQuestions() {
    const response = await fetch('/api/questions');
    const data = await response.json();
    displayQuestions(data, 'all');
}

async function addQuestion() {
    const newQuestionInput = document.getElementById('new-question');
    const newQuestionText = newQuestionInput.value.trim();

    if (newQuestionText !== '') {
        const response = await fetch('/api/questions', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ question: newQuestionText })
        });
        const newQuestion = await response.json();
        loadQuestions(); // Refresh questions
        newQuestionInput.value = ''; // Clear input field
    }
}

async function addReply() {
    const newReplyInput = document.getElementById('new-reply');
    const newReplyText = newReplyInput.value.trim();
    const questionId = currentQuestion.id;

    if (newReplyText !== '') {
        const authorName = window.authUser.name; // Get the authenticated user's name
        const response = await fetch(`/api/questions/${questionId}/replies`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ author: authorName, text: newReplyText })
        });
        const newReply = await response.json();
        showQuestionDetail(currentQuestion.id); // Refresh question details
        newReplyInput.value = ''; // Clear input field
    }
}

async function searchQuestions() {
    const query = document.getElementById('search').value.toLowerCase();
    const response = await fetch(`/api/questions/search/${query}`);
    const data = await response.json();
    displayQuestions(data, 'search');
}

function displayQuestions(questions, tab) {
    const questionsContainer = document.getElementById('questions-container');
    questionsContainer.innerHTML = ''; // Clear container

    questions.forEach(question => {
        const questionElement = document.createElement('div');
        questionElement.className = 'question';
        questionElement.onclick = () => showQuestionDetail(question.id);

        questionElement.innerHTML = `
            <div class="question-info">
                <img src="assest/avatar.png" alt="Avatar">
                <div class="question-details">
                    <h2>${question.question}</h2>
                    <div class="meta">
                        <span>${question.views} views</span>
                        <span>${question.comments} comments</span>
                    </div>
                </div>
            </div>
            <div class="question-actions">
                <span>${question.likes}</span>
                <img src="assest/heart.png" alt="Like">
            </div>
        `;
        questionsContainer.appendChild(questionElement);
    });
}

let currentQuestion;

async function showQuestionDetail(questionId) {
    const response = await fetch(`/api/questions/${questionId}`);
    currentQuestion = await response.json();

    const questionDetailContainer = document.getElementById('question-detail');
    const questionDetailContent = document.getElementById('question-detail-content');

    questionDetailContent.innerHTML = `
        <h2>${currentQuestion.question}</h2>
        <div class="meta">
            <span>${currentQuestion.views} views</span>
            <span>${currentQuestion.comments} comments</span>
            <span>${currentQuestion.likes} likes</span>
        </div>
        <div class="replies">
            ${currentQuestion.replies.map(reply => `
                <div class="reply">
                    <h3>${reply.author}</h3>
                    <p>${reply.text}</p>
                </div>
            `).join('')}
        </div>
        <div class="reply-section">
            <h2>Reply to this question</h2>
            <textarea placeholder="Your Reply" id="new-reply"></textarea>
            <button onclick="addReply()">Submit Reply</button>
        </div>
    `;

    questionDetailContainer.classList.remove('hidden');
    questionDetailContainer.classList.add('visible');
}

function backToQuestions() {
    const questionDetailContainer = document.getElementById('question-detail');
    questionDetailContainer.classList.remove('visible');
    questionDetailContainer.classList.add('hidden');
    loadQuestions();
}

