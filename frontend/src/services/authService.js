import axios from 'axios'

const API_BASE_URL = 'http://localhost:8000/api'

const apiClient = axios.create({
  baseURL: API_BASE_URL,
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json',
  },
})

export async function registerStudent(formData) {
  const payload = {
    name: formData.fullName,
    university: formData.university,
    academic_major: formData.major,
    email: formData.email,
    password: formData.password,
    password_confirmation: formData.confirmPassword,
  }

  const response = await apiClient.post('/register/student', payload)
  const { student, token } = response.data

  localStorage.setItem('auth_token', token)
  localStorage.setItem('auth_user', JSON.stringify(student))

  return { student, token }
}