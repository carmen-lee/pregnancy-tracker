## Problem Statement: 
Your task is to design and implement a pregnancy tracking system. The application needs to keep record of the following:
- Patients.
- Pregnancy/ies
- Doctors.
- Appointments.
- Medications.
## User Interfaces:
### Patient portal:
- Personal information: 
    - The patient should be able to see their personal information and keep track of the pregnancy information such as due date. 
- Pregnancy/ies: 
    - Note that a patient can be entered into the system multiple times for multiple pregnancies. Patients should be able to see their previous records.
- Appointments: 
    - Patients need to have access to their appointments. The information should include the appointment date and time, doctor’s name, and some summary of the appointment.
- Medications: 
    - Patients need to have access to the medications prescribed to them along with the dosage.
- Request an appointment: 
    - The patient should be able to request an appointment and the system admin, or the doctor can approve that appointment (it is up to you to select one of these or both).
Keep in mind that all patient interfaces are view only except the information page and request appointment page. i.e. the patient cannot update any information on those pages.

### Doctors Portal: 
- Appointments: 
    - Doctors should be able to view upcoming appointments including patient information. There should be a hyperlink that takes the doctor to the patient information page where they’ll see the entire patient record.
- Prescribe Medications: 
    - Doctors should be able to prescribe medications to patients.
- Searching: 
    - Doctors need to be able to search for patients using some patient information.
- Schedule appointments: 
    - The doctor should be able to schedule an appointment with patients.

### System Admin Portal:
- Create a doctor account: 
    - The system admin should be able to create a doctor’s account by entering the username, password, and other doctor information.
- Search, edit, and delete: 
    - The admin should be able to search, edit and delete any record in the system.
- Signup, login, and reset pwd:
    - The system will have a signup page. Upon signing up, a patient account will be created. The user can enter their personal information at this point or at a later point.
    - All users can change their password by providing the old password and the new password.
    - You need to have a single login page that will take the user to the correct portal based on the user’s type.
