Entities
---
* User
* Course
* Question
* Exam
* Submission

User
---
* Admin
  * Manage Course
    * [ ] Add/Edit/Delete Course
  
  * Manage Faculty
    * [ ] Add/Edit/Delete Faculties
    * [ ] Assign Student => Faculty
    * [ ] Assign Course => Faculty
    
  * Manage Student
    * [ ] Add/Edit/Delete Student
  
* Faculty
  * [ ] View performance of *one* Student
  * [ ] View performance of *one* Course as a summary/table view
  * [ ] Add/Edit/Delete Question

Exams can have a set of questions predefined and the system will auto-generate the questions based
on the predefined set of questions. For example, if a teacher has predefined 100 questions and set
that an exam will be held based on those questions but the exam will contain only 20 questions,
then the system will permutate to create a unique question set for each student. This question set
along with the answers/files of the Students will be stored as a Submission. The submissions will
be downloadable by the Faculty. If the submission is a code file or text filed it should be
viewable in the browser. This unique **Question set system** will ensure that students cannot cheat
by copying other's answers because, the questions themselves will probably be different for each
student and also their ordering.

When a teacher sets an exam, Exam for each student will be generated based on the list of predefined
Questions. A corresponding Submission will also be created for each Exam per Student. This will have
no value initially. Once the user selects/answers then this Submission will get updated. Each Exam
will have a *start* and an *end* time. Student can only answer during this time period. MCQ type
questions will be graded on the fly as the Submissions are updated.
