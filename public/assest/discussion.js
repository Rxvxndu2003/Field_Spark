document.addEventListener('DOMContentLoaded',() => {
    loadQuestions();
    document.getElementById('search').addEventListener('input', searchQuestions);
});

async function loadQuestions() {
    try {
        const response = await fetch('/api/questions');
        const data = await response.json();
        displayQuestions(data, 'all');
    } catch (error) {
        console.error('Error loading questions:', error);
    }
}

async function addQuestion() {
    const newQuestionInput = document.getElementById('new-question');
    const newQuestionText = newQuestionInput.value.trim();

    if (newQuestionText !== '') {
        try {
            const response = await fetch('/api/questions', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ question: newQuestionText })
            });
            const newQuestion = await response.json();
            loadQuestions(); // Refresh questions
            newQuestionInput.value = ''; // Clear input field
        } catch (error) {
            console.error('Error adding question:', error);
        }
    }
}

async function addReply() {
    const newReplyInput = document.getElementById('new-reply');
    const newReplyText = newReplyInput.value.trim();
    const questionId = currentQuestion.id;

    if (newReplyText !== '') {
        // Ensure authUser is available and has a name property
        const authorName = window.authUser && window.authUser.name ? window.authUser.name: 'Instructor';
        try {
            const response = await fetch(`/api/questions/${questionId}/replies`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ author: authorName, text: newReplyText })
            });

            // Check if the response is successful
            if (!response.ok) {
                throw new Error(`Error: ${response.statusText}`);
            }

            const newReply = await response.json();
            showQuestionDetail(currentQuestion.id); // Refresh question details
            newReplyInput.value = ''; // Clear input field
        } catch (error) {
            console.error('Error adding reply:', error);
        }
    }
}



async function searchQuestions() {
    const query = document.getElementById('search').value.toLowerCase();
    try {
        const response = await fetch(`/api/questions/search/${query}`);
        const data = await response.json();
        displayQuestions(data, 'search');
    } catch (error) {
        console.error('Error searching questions:', error);
    }
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
               <span id="likes-${question.id}">${question.likes}</span>
                <img src="assest/heart.png" alt="Like" onclick="likeQuestion(${question.id})">
            </div>
        `;
        questionsContainer.appendChild(questionElement);
    });
}

async function likeQuestion(questionId) {
    try {
        const response = await fetch(`/api/questions/${questionId}/like`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            credentials: 'same-origin',
        });

        if (!response.ok) {
            throw new Error(`Error: ${response.statusText}`);
        }

        // Assuming the server returns the updated likes count
        const data = await response.json();
        const likesElement = document.getElementById(`likes-${questionId}`);
        likesElement.textContent = data.likes; // Update the likes count in the UI
    } catch (error) {
        console.error('Error liking question:', error);
    }
}


let currentQuestion;

async function showQuestionDetail(questionId) {
    try {
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
    } catch (error) {
        console.error('Error loading question detail:', error);
    }
}

function backToQuestions() {
    const questionDetailContainer = document.getElementById('question-detail');
    questionDetailContainer.classList.remove('visible');
    questionDetailContainer.classList.add('hidden');
    loadQuestions();
}
