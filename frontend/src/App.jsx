import { Routes, Route } from 'react-router-dom'
import StudentRegistration from './pages/StudentRegistration'

function App() {
  return (
    <Routes>
      <Route path="/register/student" element={<StudentRegistration />} />
      <Route path="/register/organization" element={<div>Coming soon</div>} />
      <Route path="/login" element={<div>Coming soon</div>} />
    </Routes>
  )
}

export default App