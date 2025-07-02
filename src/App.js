import JeeRankPredictor from './page/JeeRankPredictor/JeeRankPredictor';
import KotaCoachingForJEENEET from './page/KotaCoachingForJEENEET/KotaCoachingForJEENEET';
import NeetRankPredictor from './page/NeetRankPredictor/NeetRankPredictor';
import NeetMarksCalculator from './page/NeetMarksCalculator/NeetMarksCalculator';
import NeetAnswerKey2025 from './page/NeetAnswerKey2025/NeetAnswerKey2025';
import JeeMainAnswerKeyPaper2025 from './page/JeeMainAnswerKeyPaper2025/JeeMainAnswerKeyPaper2025';
import Page404 from './page/page404';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import Header from './components/Header/Header';
import Footer from './components/Footer/Footer';
import './MotionNodeAPI.json';
import './App.css';
function App() {
  return (
    <Router>
      <Header/>
      <Routes>
        {/* Define the routes for the components */}
        <Route path="/jee-main-rank-predictor" element={<JeeRankPredictor />} />
        <Route path="/kota-coachings-for-jee-neet" element={<KotaCoachingForJEENEET />} />
        <Route path="/neet-rank-predictor" element={<NeetRankPredictor />} />
        <Route path="/neet-marks-calculator" element={<NeetMarksCalculator/>} />
        <Route path="/neet-answer-key-solutions-2025" element={<NeetAnswerKey2025/>} />
        <Route path="/jee-main-answer-key-paper-solutions-2025" element={<JeeMainAnswerKeyPaper2025/>} />
        
        {/* You can also set a default route or home page */}
        <Route path="/" element={<Home />} />
        <Route path="*" element={<Page404/>} />
      </Routes>
      <Footer/>
    </Router>
   
  );
}

function Home() {
  return (
   <h1 className='text-center'>API run successfully</h1>
  );
}

export default App;
