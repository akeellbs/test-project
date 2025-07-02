const Section8 = ({styles}) => {
    const marksVsRank = [
        { id: 1, marks: "285-300", rank: "Top 100" },
        { id: 2, marks: "275-284", rank: "100-200" },
        { id: 3, marks: "260-274", rank: "200-500" },
        { id: 4, marks: "250-259", rank: "500-1000" },
        { id: 5, marks: "240-249", rank: "1000-1500" },
        { id: 6, marks: "220-239", rank: "1500-3500" },
        { id: 7, marks: "200-219", rank: "3500-6000" },
        { id: 8, marks: "180-199", rank: "6000-9500" },
        { id: 9, marks: "150-180", rank: "9500-15000" },
        { id: 10, marks: "120-149", rank: "15000-35000" }
    ];
    const percentileVsRank = [
        { id: 1, percentile: "100.0000000 - 99.9986893", rank: "1-50" },
        { id: 2, percentile: "99.9986893 - 99.9960638", rank: "51-100" },
        { id: 3, percentile: "99.9960638 - 99.9880635", rank: "101-200" },
        { id: 4, percentile: "99.9880635 - 99.9653134", rank: "201-500" },
        { id: 5, percentile: "99.9653134 - 99.9213162", rank: "501-1000" },
        { id: 6, percentile: "99.9213162 - 99.8791833", rank: "1001-1500" },
        { id: 7, percentile: "99.8791833 - 99.8372675", rank: "1501-2000" },
        { id: 8, percentile: "99.8372675 - 99.7923244", rank: "2001-2500" },
        { id: 9, percentile: "99.7923244 - 99.7474427", rank: "2501-3000" },
        { id: 10, percentile: "99.7474427 - 99.7064984", rank: "3001-3500" }
    ];
    return (
        <section className={`${styles.section_8} p-6 bg-gray-100`}>
            <div className="container mx-auto">
                <h2 className="text-2xl font-bold mb-4">JEE Main Rank Predictor 2025 (FREE)</h2>
                <p className="mb-4">
                    After the completion of the JEE Main 2025 exam, one of the biggest questions on every student’s mind is: What will my rank be? A good rank is key to securing admission to your dream college, and Motion is here to help you predict it!
                </p>
                <p className="mb-4">
                    Motion's <b>JEE Main Rank Predictor 2025</b> is designed to estimate your rank based on your expected percentile and scores. By analyzing the JEE Main 2025 Answer Key and using advanced calculations, the rank predictor provides accurate results. It considers factors like:
                </p>
                <ul className="list-disc pl-6 mb-4">
                    <li>Previous years' cutoffs</li>
                    <li>Seat availability</li>
                    <li>Category-specific quotas</li>
                </ul>
                <p className="mb-4">
                    The tool also analyzes your normalized scores, takes into account exam difficulty, and compares data from thousands of students to ensure precision.
                </p>
                <p className="mb-4">
                    Motion's JEE Main 2025 Rank Predictor doesn’t just calculate your expected rank—it also suggests potential colleges you may qualify for based on your rank. It’s a simple and free tool available on Motion’s website.
                </p>

                <h3 className="text-xl font-semibold mb-3">JEE Main Rank Predictor 2025 – Key Highlights</h3>
                <ul className="list-disc pl-6 mb-4">
                    <li>The accuracy of Motion's JEE Main 2025 rank and college predictions depends on the details entered by the candidates.</li>
                    <li>Powered by advanced artificial intelligence, the tool estimates JEE Main ranks effectively.</li>
                    <li>Students can get an idea of their All India Rank (AIR) even before the official JEE Main 2025 results are announced.</li>
                    <li>After predicting your rank, the tool helps identify potential colleges where you may secure admission.</li>
                </ul>

                <h3 className="text-xl font-semibold mb-3">JEE Main 2025 Rank Predictor: Check Rank vs Percentile</h3>
                <div className="table-responsive">
                    <table className="table table-bordered">
                        <thead>
                            <tr className="bg-gray-200">
                                <th className="border border-gray-300 px-4 py-2">S.No.</th>
                                <th className="border border-gray-300 px-4 py-2">JEE Main Percentile Scores</th>
                                <th className="border border-gray-300 px-4 py-2">Expected JEE Main Rank</th>
                            </tr>
                        </thead>
                        <tbody>
                            {[
                                { sNo: 1, percentile: 100, rank: 1 },
                                { sNo: 2, percentile: 99, rank: '8746+' },
                                { sNo: 3, percentile: 98, rank: '17,490+' },
                                { sNo: 4, percentile: 97, rank: '26,235+' },
                                { sNo: 5, percentile: 96, rank: '34,980+' },
                                { sNo: 6, percentile: 95, rank: '43,724+' },
                                { sNo: 7, percentile: 94, rank: '52,469+' },
                                { sNo: 8, percentile: 93, rank: '61,214+' },
                                { sNo: 9, percentile: 92, rank: '69,959+' },
                                { sNo: 10, percentile: 91, rank: '78,703+' },
                            ].map((row, index) => (
                                <tr key={index} className="border border-gray-300">
                                    <td className="border border-gray-300 px-4 py-2">{row.sNo}</td>
                                    <td className="border border-gray-300 px-4 py-2">{row.percentile}</td>
                                    <td className="border border-gray-300 px-4 py-2">{row.rank}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
                <h3 className="text-xl font-bold mb-2">JEE Main Rank 2025: Marks vs Rank</h3>
                <p className="mb-4">Since we have learned about the JEE main rank prediction based on percentile as well as percentile vs rank prediction, here are mark vs rank trends for 2021.</p>
                <div className="table-responsive">
                    <table className="table table-bordered">
                        <thead>
                            <tr className="bg-gray-200">
                                <th className="border p-2">S.No.</th>
                                <th className="border p-2">Marks</th>
                                <th className="border p-2">Rank</th>
                            </tr>
                        </thead>
                        <tbody>
                            {marksVsRank.map((row) => (
                                <tr key={row.id} className="border">
                                    <td className="border p-2 text-center">{row.id}</td>
                                    <td className="border p-2 text-center">{row.marks}</td>
                                    <td className="border p-2 text-center">{row.rank}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
                <h3 className="text-xl font-bold mt-6 mb-2">JEE Main Rank Predictor from Percentile: Check Percentile vs AIR</h3>
                <p className="mb-4">JEE Main Rank Predictor helps you estimate the rank you may achieve based on your JEE Main 2025 percentile.</p>
                <div className="table-responsive">
                    <table className="table table-bordered">
                        <thead>
                            <tr className="bg-gray-200">
                                <th className="border p-2">S.No.</th>
                                <th className="border p-2">Percentile Score</th>
                                <th className="border p-2">CRL All India Rank</th>
                            </tr>
                        </thead>
                        <tbody>
                            {percentileVsRank.map((row) => (
                                <tr key={row.id} className="border">
                                    <td className="border p-2 text-center">{row.id}</td>
                                    <td className="border p-2 text-center">{row.percentile}</td>
                                    <td className="border p-2 text-center">{row.rank}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    );
};

export default Section8;
