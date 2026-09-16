import { useState } from 'react'
import AuthLayout from '../components/auth/AuthLayout'
import TextInput from '../components/common/TextInput'
import PasswordInput from '../components/common/PasswordInput'
import Button from '../components/common/Button'
import { registerStudent } from '../services/authService'

function StudentRegistrationPage() {
  const [formData, setFormData] = useState({
    fullName: '',
    university: '',
    major: '',
    email: '',
    password: '',
    confirmPassword: '',
  })

  const [errors, setErrors] = useState({})
  const [status, setStatus] = useState('idle')

  const handleChange = (e) => {
    const { name, value } = e.target
    setFormData((prev) => ({ ...prev, [name]: value }))
  }

  const validate = () => {
    const newErrors = {}

    if (!formData.fullName.trim()) newErrors.fullName = 'الاسم الكامل مطلوب'
    if (!formData.university.trim()) newErrors.university = 'اسم الجامعة مطلوب'
    if (!formData.major.trim()) newErrors.major = 'التخصص مطلوب'

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    if (!emailRegex.test(formData.email)) {
      newErrors.email = 'البريد الالكتروني غير صحيح'
    }

    if (formData.password.length < 8) {
      newErrors.password = 'كلمة المرور يجب أن تكون 8 حروف على الأقل'
    }
    if (formData.password !== formData.confirmPassword) {
      newErrors.confirmPassword = 'كلمتا المرور غير متطابقتين'
    }

    setErrors(newErrors)
    return Object.keys(newErrors).length === 0
  }

  const handleSubmit = async (e) => {
    e.preventDefault()
    if (!validate()) return

    setStatus('loading')
    setErrors({})

    try {
      await registerStudent(formData)
      setStatus('success')
    } catch (err) {
      setStatus('error')

      if (err.response?.data?.errors) {
        const backendErrors = {}
        const errorsFromApi = err.response.data.errors

        const fieldMap = {
          name: 'fullName',
          academic_major: 'major',
          university: 'university',
          email: 'email',
          password: 'password',
        }

        Object.keys(errorsFromApi).forEach((backendField) => {
          const frontendField = fieldMap[backendField] || backendField
          backendErrors[frontendField] = errorsFromApi[backendField][0]
        })

        setErrors(backendErrors)
      }
    }
  }

  return (
    <AuthLayout title="تسجيل حساب طالب">
      <form onSubmit={handleSubmit} className="space-y-4">
        <TextInput
          label="الاسم الكامل"
          name="fullName"
          value={formData.fullName}
          onChange={handleChange}
          error={errors.fullName}
        />
        <TextInput
          label="الجامعة"
          name="university"
          value={formData.university}
          onChange={handleChange}
          error={errors.university}
        />
        <TextInput
          label="التخصص"
          name="major"
          value={formData.major}
          onChange={handleChange}
          error={errors.major}
        />
        <TextInput
          label="البريد الإلكتروني"
          name="email"
          type="email"
          value={formData.email}
          onChange={handleChange}
          error={errors.email}
        />
        <PasswordInput
          label="كلمة المرور"
          name="password"
          value={formData.password}
          onChange={handleChange}
          error={errors.password}
        />
        <PasswordInput
          label="تأكيد كلمة المرور"
          name="confirmPassword"
          value={formData.confirmPassword}
          onChange={handleChange}
          error={errors.confirmPassword}
        />

        <Button type="submit" loading={status === 'loading'} loadingText="جاري إنشاء الحساب...">
          إنشاء حساب
        </Button>

        {status === 'success' && (
          <p className="text-green-600 text-center">تم إنشاء الحساب</p>
        )}
        {status === 'error' && (
          <p className="text-red-600 text-center">حدث خطأ، حاول مرة أخرى</p>
        )}
      </form>
    </AuthLayout>
  )
}

export default StudentRegistrationPage